<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RfidLog extends Model
{
    use HasFactory;

    protected $table = 'rfid_logs';

    protected $fillable = [
        'rfid_card_id',
        'participant_id',
        'station_id',
        'uid',
        'event_type',
        'event_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'event_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function rfidCard(): BelongsTo
    {
        return $this->belongsTo(RfidCard::class);
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
