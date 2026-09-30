<?php

namespace App\Models;

use App\Enums\RfidStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RfidCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rfid_cards';

    protected $fillable = [
        'uid',
        'participant_id',
        'status',
        'registered_at',
        'unregistered_at',
        'last_used_at',
        'last_station_id',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
            'unregistered_at' => 'datetime',
            'last_used_at' => 'datetime',
            'metadata' => 'array',
            'status' => RfidStatus::class,
        ];
    }

    // ===========================
    // Relationships — DATABASE.md section 66
    // ===========================

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function lastStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'last_station_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function rfidLogs(): HasMany
    {
        return $this->hasMany(RfidLog::class);
    }

    // ===========================
    // Helpers
    // ===========================

    /**
     * Cek apakah RFID aktif dan dapat digunakan untuk absensi.
     */
    public function isActive(): bool
    {
        return $this->status === RfidStatus::ACTIVE;
    }

    /**
     * Cek apakah RFID sudah di-assign ke peserta.
     */
    public function isAssigned(): bool
    {
        return $this->participant_id !== null && $this->status === RfidStatus::ACTIVE;
    }
}
