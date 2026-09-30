<?php

/**
 * PCNU Absensi — Konfigurasi custom
 *
 * Nilai default dapat di-override melalui:
 * - .env
 * - settings table (untuk nilai yang dapat diubah via UI)
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Station Online Threshold
    |--------------------------------------------------------------------------
    | Waktu (menit) batas station dianggap ONLINE berdasarkan last_seen_at.
    | Jika last_seen_at < threshold menit lalu → ONLINE
    | Jika last_seen_at >= threshold menit lalu → OFFLINE
    |
    */
    'station_online_threshold_minutes' => env('STATION_ONLINE_THRESHOLD_MINUTES', 2),

    /*
    |--------------------------------------------------------------------------
    | Attendance Duplicate Window
    |--------------------------------------------------------------------------
    | Waktu (detik) jendela pendeteksian duplikat absensi.
    | Jika peserta scan dalam rentang ini → DUPLICATE
    |
    */
    'attendance_duplicate_window_seconds' => env('ATTENDANCE_DUPLICATE_WINDOW_SECONDS', 30),

    /*
    |--------------------------------------------------------------------------
    | Heartbeat Interval
    |--------------------------------------------------------------------------
    | Interval (detik) heartbeat dari station agent ke server.
    |
    */
    'heartbeat_interval_seconds' => env('HEARTBEAT_INTERVAL_SECONDS', 30),

];
