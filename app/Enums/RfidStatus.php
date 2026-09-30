<?php

namespace App\Enums;

enum RfidStatus: string
{
    case ACTIVE = 'ACTIVE';
    case UNASSIGNED = 'UNASSIGNED';
    case DISABLED = 'DISABLED';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Aktif',
            self::UNASSIGNED => 'Tidak Terpasang',
            self::DISABLED => 'Dinonaktifkan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::UNASSIGNED => 'amber',
            self::DISABLED => 'red',
        };
    }
}
