<?php

namespace App\Enums;

enum StationType: string
{
    case IN = 'IN';
    case OUT = 'OUT';

    public function label(): string
    {
        return match($this) {
            self::IN => 'Masuk',
            self::OUT => 'Keluar',
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
