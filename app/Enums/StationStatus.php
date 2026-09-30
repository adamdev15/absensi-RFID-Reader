<?php

namespace App\Enums;

enum StationStatus: string
{
    case ACTIVE = 'ACTIVE';
    case DISABLED = 'DISABLED';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Aktif',
            self::DISABLED => 'Dinonaktifkan',
        };
    }
}
