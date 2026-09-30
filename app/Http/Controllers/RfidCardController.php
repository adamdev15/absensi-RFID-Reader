<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\RfidCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RfidCardController extends Controller
{
    public function index(Request $request)
    {
        $query = RfidCard::with(['participant', 'lastStation']);

        // Search based on UID or Participant Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('uid', 'like', "%{$search}%")
                  ->orWhereHas('participant', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('participant_code', 'like', "%{$search}%");
                  });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rfidCards = $query->latest('updated_at')->paginate(15)->withQueryString();
        
        // Data for Modal Dropdown (Peserta yang aktif dan belum punya RFID aktif)
        $availableParticipants = Participant::where('status', 'ACTIVE')
            ->whereDoesntHave('rfidCards', function($q) {
                $q->where('status', 'ACTIVE');
            })
            ->orderBy('name')
            ->get();

        return view('rfid.index', compact('rfidCards', 'availableParticipants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => ['required', 'string', 'max:50', 'unique:rfid_cards,uid'],
            'participant_id' => ['required', 'exists:participants,id'],
        ]);

        try {
            DB::beginTransaction();

            // Pastikan peserta belum punya RFID aktif
            $participant = Participant::findOrFail($request->participant_id);
            if ($participant->activeRfidCard()) {
                return back()->with('error', 'Peserta ini sudah memiliki kartu RFID yang aktif.');
            }

            RfidCard::create([
                'uid' => strtoupper($request->uid),
                'participant_id' => $participant->id,
                'status' => 'ACTIVE',
                'registered_at' => now(),
            ]);

            DB::commit();
            return back()->with('success', 'Kartu RFID berhasil didaftarkan dan dihubungkan ke peserta.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mendaftarkan RFID: ' . $e->getMessage());
        }
    }

    public function update(Request $request, RfidCard $rfid)
    {
        // Fitur ini digunakan untuk assign RFID yang statusnya UNASSIGNED ke peserta
        $request->validate([
            'participant_id' => ['required', 'exists:participants,id'],
        ]);

        try {
            DB::beginTransaction();

            $participant = Participant::findOrFail($request->participant_id);
            if ($participant->activeRfidCard()) {
                return back()->with('error', 'Peserta ini sudah memiliki kartu RFID yang aktif.');
            }

            $rfid->update([
                'participant_id' => $participant->id,
                'status' => 'ACTIVE',
                'registered_at' => now(),
                'unregistered_at' => null
            ]);

            DB::commit();
            return back()->with('success', 'Kartu RFID berhasil dihubungkan ke peserta.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghubungkan RFID: ' . $e->getMessage());
        }
    }

    public function destroy(RfidCard $rfid)
    {
        // RFID tidak benar-benar dihapus (soft delete / status change) untuk keperluan audit
        // Namun di PRD, jika dihapus kita bisa hapus permanen ATAU ubah status.
        // Mari kita ubah status menjadi BLOCKED atau cabut kepemilikan (UNASSIGNED)
        
        $rfid->update([
            'status' => 'UNASSIGNED',
            'participant_id' => null,
            'unregistered_at' => now()
        ]);

        return back()->with('success', 'Akses kartu RFID berhasil dicabut dari peserta.');
    }
}
