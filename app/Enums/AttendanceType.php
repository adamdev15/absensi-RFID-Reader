<?php

namespace App\Enums;

enum AttendanceType: string
{
    case IN = 'IN';
    case OUT = 'OUT';

    public function label(): string
    {
        return match($this) {
            self::IN => 'Absen Masuk',
            self::OUT => 'Absen Keluar',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::IN => 'green',
            self::OUT => 'blue',
        };
    }
}
