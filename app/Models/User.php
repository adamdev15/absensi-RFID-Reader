<?php

namespace App\Models;

use App\Enums\UserStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'status',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class,
        ];
    }

    // ===========================
    // Relationships
    // ===========================

    /**
     * Stations yang di-assign ke user ini.
     */
    public function stations(): BelongsToMany
    {
        return $this->belongsToMany(Station::class, 'station_user')
            ->withPivot('assigned_at', 'assigned_by')
            ->withTimestamps();
    }

    /**
     * Activity logs oleh user ini.
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Backup yang dibuat user ini.
     */
    public function backups(): HasMany
    {
        return $this->hasMany(Backup::class, 'created_by');
    }

    // ===========================
    // Helpers
    // ===========================

    /**
     * Override guard_name untuk Spatie Permission.
     */
    protected string $guard_name = 'web';

    /**
     * Cek apakah user aktif.
     */
    public function isActive(): bool
    {
        return $this->status === UserStatus::ACTIVE;
    }
}
