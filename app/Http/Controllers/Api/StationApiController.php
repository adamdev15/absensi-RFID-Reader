<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Participant;
use App\Models\RfidCard;
use App\Models\Station;
use App\Models\StationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StationApiController extends Controller
{
    /**
     * Authenticate Station from Bearer Token
     */
    private function authenticateStation(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return null;
        }

        // We hash the incoming token because we might store it hashed (if using full sanctum)
        // Since we are using simple custom token, we check plain_token or token directly.
        // For simplicity in this project (as per PRD), we check against plain_token directly 
        // since we haven't implemented full Sanctum/Passport.
        $stationToken = StationToken::where('plain_token', $token)->first();
        
        if (!$stationToken) {
            return null;
        }

        return $stationToken->station;
    }

    /**
     * POST /api/station/heartbeat
     * Menerima ping dari python station agent
     */
    public function heartbeat(Request $request)
    {
        $station = $this->authenticateStation($request);
        if (!$station) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($station->status->value !== 'ACTIVE') {
            return response()->json(['error' => 'Station is inactive or maintenance'], 403);
        }

        // Update last seen
        $station->update([
            'last_seen_at' => now(),
            'operational_status' => 'ONLINE'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Heartbeat received',
            'server_time' => now()->toDateTimeString(),
            'station_type' => $station->type->value
        ]);
    }

    /**
     * POST /api/station/attendance
     * Menerima sinkronisasi absensi (offline queue dari Python Station)
     */
    public function syncAttendance(Request $request)
    {
        $station = $this->authenticateStation($request);
        if (!$station) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validasi input array of records
        $request->validate([
            'records' => ['required', 'array'],
            'records.*.uid' => ['required', 'string'],
            'records.*.type' => ['required', 'string', 'in:IN,OUT'],
            'records.*.timestamp' => ['required', 'date_format:Y-m-d H:i:s'],
            'records.*.photo' => ['nullable', 'string'] // base64 photo
        ]);

        $successCount = 0;
        $failedCount = 0;
        $unregisteredUids = [];

        foreach ($request->records as $record) {
            try {
                DB::beginTransaction();

                $rfid = RfidCard::where('uid', strtoupper($record['uid']))->first();

                if (!$rfid) {
                    // Kartu benar-benar baru, simpan sebagai UNASSIGNED
                    RfidCard::create([
                        'uid' => strtoupper($record['uid']),
                        'status' => 'UNASSIGNED',
                        'last_station_id' => $station->id,
                        'registered_at' => null
                    ]);
                    $unregisteredUids[] = $record['uid'];
                    $failedCount++;
                    DB::commit();
                    continue;
                }

                if ($rfid->status->value !== 'ACTIVE' || !$rfid->participant_id) {
                    // Kartu ada tapi belum di-assign atau terblokir
                    $failedCount++;
                    DB::commit();
                    continue;
                }

                $participant = $rfid->participant;

                // Cek jika sudah absen di rentang waktu yang berdekatan (Anti-spam 1 menit)
                $recentAttendance = Attendance::where('participant_id', $participant->id)
                    ->where('type', $record['type'])
                    ->where('attendance_at', '>=', \Carbon\Carbon::parse($record['timestamp'])->subMinutes(1))
                    ->exists();

                if ($recentAttendance) {
                    $failedCount++;
                    DB::rollBack();
                    continue; // Skip duplicate
                }

                // Proses file base64
                $photoPath = null;
                if (!empty($record['photo'])) {
                    $photoData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $record['photo']));
                    $filename = 'attendances/' . date('Y/m/') . $participant->id . '_' . time() . '.jpg';
                    \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $photoData);
                    $photoPath = $filename;
                }

                // Simpan absensi
                Attendance::create([
                    'attendance_uuid' => (string) \Illuminate\Support\Str::uuid(),
                    'attendance_code' => 'ATT-' . date('YmdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                    'participant_id' => $participant->id,
                    'rfid_card_id' => $rfid->id,
                    'station_id' => $station->id,
                    'type' => $record['type'],
                    'rfid_uid' => $record['uid'],
                    'attendance_at' => $record['timestamp'],
                    'capture_path' => $photoPath,
                    'status' => 'SUCCESS',
                    'source' => 'OFFLINE',
                    'synced_at' => now(),
                    'participant_name_snapshot' => $participant->name,
                    'participant_code_snapshot' => $participant->participant_code,
                    'utusan_name_snapshot' => $participant->utusan?->name,
                    'jabatan_name_snapshot' => $participant->jabatan?->name,
                    'mwcnu_name_snapshot' => $participant->mwcnu?->name,
                    'station_name_snapshot' => $station->name
                ]);

                \App\Models\ActivityLog::create([
                    'station_id' => $station->id,
                    'action' => 'SYNC_ABSENSI',
                    'module' => 'Absensi',
                    'description' => "Sinkronisasi absensi berhasil untuk {$participant->name} (UID: {$record['uid']}) dari Station {$station->name}",
                    'ip_address' => $request->ip()
                ]);

                $successCount++;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Failed to sync attendance record", ['error' => $e->getMessage(), 'record' => $record]);
                $failedCount++;
            }
        }

        return response()->json([
            'status' => 'success',
            'synced' => $successCount,
            'failed' => $failedCount,
            'unassigned_uids_found' => $unregisteredUids
        ]);
    }

    /**
     * POST /api/station/check-rfid
     * Mengecek data peserta berdasarkan RFID (Untuk UI realtime Kiosk)
     */
    public function checkRfid(Request $request)
    {
        $station = $this->authenticateStation($request);
        if (!$station) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'uid' => 'required|string'
        ]);

        $rfid = RfidCard::where('uid', strtoupper($request->uid))->first();

        if (!$rfid) {
            return response()->json([
                'status' => 'not_registered',
                'message' => 'Kartu tidak terdaftar'
            ]);
        }

        if ($rfid->status->value !== 'ACTIVE' || !$rfid->participant_id) {
            return response()->json([
                'status' => 'unassigned',
                'message' => 'Kartu belum dihubungkan ke peserta'
            ]);
        }

        $participant = $rfid->participant;

        // Cek duplicate absensi dalam 30 detik terakhir
        $duplicate = \App\Models\Attendance::where('participant_id', $participant->id)
            ->where('type', $station->type->value)
            ->where('attendance_at', '>=', now()->subSeconds(30))
            ->latest('attendance_at')
            ->first();

        if ($duplicate) {
            return response()->json([
                'status' => 'DUPLICATE',
                'message' => 'Absensi sudah tercatat sebelumnya.',
                'data' => [
                    'name' => $participant->name,
                    'code' => $participant->participant_code,
                    'utusan' => $participant->utusan?->name ?? '-',
                    'mwcnu' => $participant->mwcnu?->name ?? '-'
                ]
            ]);
        }

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Silahkan masuk',
            'data' => [
                'name' => $participant->name,
                'code' => $participant->participant_code,
                'utusan' => $participant->utusan?->name ?? '-',
                'mwcnu' => $participant->mwcnu?->name ?? '-'
            ]
        ]);
    }
}
