<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case SUCCESS = 'SUCCESS';
    case REJECTED = 'REJECTED';
    case DUPLICATE = 'DUPLICATE';
    case PENDING_SYNC = 'PENDING_SYNC';
    case SYNCED = 'SYNCED';

    public function label(): string
    {
        return match($this) {
            self::SUCCESS => 'Berhasil',
            self::REJECTED => 'Ditolak',
            self::DUPLICATE => 'Duplikat',
            self::PENDING_SYNC => 'Menunggu Sinkronisasi',
            self::SYNCED => 'Tersinkronisasi',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::SUCCESS => 'green',
            self::REJECTED => 'red',
            self::DUPLICATE => 'amber',
            self::PENDING_SYNC => 'amber',
            self::SYNCED => 'blue',
        };
    }
}
