<?php

namespace App\Enums;

enum AttendanceSource: string
{
    case ONLINE = 'ONLINE';
    case OFFLINE = 'OFFLINE';

    public function label(): string
    {
        return match($this) {
            self::ONLINE => 'Online',
            self::OFFLINE => 'Offline (Sinkronisasi)',
        };
    }
}
