<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mwcnu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mwcnu';

    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => \App\Enums\ParticipantStatus::class,
        ];
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'ACTIVE';
    }
}
