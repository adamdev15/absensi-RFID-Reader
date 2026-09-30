<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Helper function untuk mengambil nilai setting aplikasi.
     *
     * @example setting('app_name') → 'Absensi PCNU Kabupaten Tegal'
     * @example setting('primary_color', '#15803D') → '#15803D'
     */
    function setting(string $key, mixed $default = null): mixed
    {
        try {
            return Setting::get($key, $default);
        } catch (\Exception $e) {
            // Fallback ke default jika tabel belum ada (misal: sebelum migrasi)
            return $default;
        }
    }
}

if (! function_exists('app_name')) {
    /**
     * Shortcut untuk mendapatkan nama aplikasi dari settings.
     */
    function app_name(): string
    {
        return setting('app_name', config('app.name', 'Absensi PCNU Kabupaten Tegal'));
    }
}
