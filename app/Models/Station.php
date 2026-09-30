<?php

namespace App\Models;

use App\Enums\StationStatus;
use App\Enums\StationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stations';

    protected $fillable = [
        'station_code',
        'name',
        'type',
        'status',
        'hostname',
        'ip_address',
        'mac_address',
        'agent_version',
        'last_seen_at',
        'last_connected_at',
        'last_disconnected_at',
        'registered_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'type' => StationType::class,
            'status' => StationStatus::class,
            'last_seen_at' => 'datetime',
            'last_connected_at' => 'datetime',
            'last_disconnected_at' => 'datetime',
            'registered_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    // ===========================
    // Relationships — DATABASE.md section 66
    // ===========================

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'station_user')
            ->withPivot('assigned_at', 'assigned_by')
            ->withTimestamps();
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function rfidLogs(): HasMany
    {
        return $this->hasMany(RfidLog::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function tokens(): HasMany
{
    return $this->hasMany(StationToken::class);
}

    // ===========================
    // Computed Properties — DATABASE.md section 26
    // Online/offline dihitung dari last_seen_at, bukan disimpan
    // ===========================

    /**
     * Status operasional station: ONLINE | OFFLINE | DISABLED
     * Threshold configurable via setting 'station_online_threshold_minutes'
     */
    public function getOperationalStatusAttribute(): string
    {
        if ($this->status === StationStatus::DISABLED) {
            return 'DISABLED';
        }

        if (! $this->last_seen_at) {
            return 'OFFLINE';
        }

        $thresholdMinutes = (int) config('pcnu.station_online_threshold_minutes', 2);

        if ($this->last_seen_at->diffInMinutes(now()) < $thresholdMinutes) {
            return 'ONLINE';
        }

        return 'OFFLINE';
    }

    public function isOnline(): bool
    {
        return $this->operational_status === 'ONLINE';
    }

    public function isDisabled(): bool
    {
        return $this->status === StationStatus::DISABLED;
    }
}
