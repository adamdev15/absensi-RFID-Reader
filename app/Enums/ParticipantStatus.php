<?php

namespace App\Enums;

enum ParticipantStatus: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Aktif',
            self::INACTIVE => 'Nonaktif',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'red',
        };
    }
}
