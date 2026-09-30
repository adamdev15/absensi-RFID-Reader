<?php

namespace App\Models;

use App\Enums\ParticipantStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'participant_code',
        'name',
        'birth_place',
        'birth_date',
        'gender',
        'utusan_id',
        'jabatan_id',
        'mwcnu_id',
        'photo_path',
        'mandate_letter_path',
        'organization',
        'status',
        'rfid_uid',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'status' => ParticipantStatus::class,
        ];
    }

    // ===========================
    // Relationships — DATABASE.md section 66
    // ===========================

    public function utusan(): BelongsTo
    {
        return $this->belongsTo(Utusan::class);
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    public function mwcnu(): BelongsTo
    {
        return $this->belongsTo(Mwcnu::class);
    }

    public function rfidCards(): HasMany
    {
        return $this->hasMany(RfidCard::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // ===========================
    // Helpers
    // ===========================

    /**
     * Mendapatkan RFID card aktif.
     */
    public function activeRfidCard(): ?RfidCard
    {
        return $this->rfidCards()->where('status', 'ACTIVE')->first();
    }

    /**
     * Cek apakah peserta aktif.
     */
    public function isActive(): bool
    {
        return $this->status === ParticipantStatus::ACTIVE;
    }

    /**
     * URL foto peserta.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }

        return null;
    }
}
