<?php

namespace App\Models;

use App\Enums\AttendanceSource;
use App\Enums\AttendanceStatus;
use App\Enums\AttendanceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Attendance — tidak menggunakan SoftDeletes
 * DATA ATTENDANCE TIDAK BOLEH DIHAPUS — DATABASE.md section 48, 67 Rule 8
 */
class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'attendance_uuid',
        'attendance_code',
        'participant_id',
        'rfid_card_id',
        'station_id',
        'type',
        'rfid_uid',
        'attendance_at',
        'participant_photo_path',
        'capture_path',
        'status',
        'source',
        'synced_at',
        'participant_name_snapshot',
        'participant_code_snapshot',
        'utusan_name_snapshot',
        'jabatan_name_snapshot',
        'mwcnu_name_snapshot',
        'station_name_snapshot',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'attendance_at' => 'datetime',
            'synced_at' => 'datetime',
            'type' => AttendanceType::class,
            'status' => AttendanceStatus::class,
            'source' => AttendanceSource::class,
            'metadata' => 'array',
        ];
    }

    // ===========================
    // Relationships — DATABASE.md section 66
    // ===========================

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function rfidCard(): BelongsTo
    {
        return $this->belongsTo(RfidCard::class);
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    // ===========================
    // Helpers
    // ===========================

    public function getCaptureUrlAttribute(): ?string
    {
        if ($this->capture_path) {
            return asset('storage/' . $this->capture_path);
        }

        return null;
    }

    public function getParticipantPhotoUrlAttribute(): ?string
    {
        if ($this->participant_photo_path) {
            return asset('storage/' . $this->participant_photo_path);
        }

        return null;
    }

    public function isSuccessful(): bool
    {
        return $this->status === AttendanceStatus::SUCCESS;
    }
}
