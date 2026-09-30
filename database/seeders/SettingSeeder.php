<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * SettingSeeder — Pengaturan default aplikasi
 * DATABASE.md section 41, 42, 43
 * PRD section 28, 29
 * STYLE.md section 31
 */
class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ===========================
            // Application
            // ===========================
            [
                'key' => 'app_name',
                'value' => 'Absensi PCNU Kabupaten Tegal',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Nama aplikasi',
            ],
            [
                'key' => 'organization_name',
                'value' => 'PCNU Kabupaten Tegal',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Nama organisasi',
            ],
            [
                'key' => 'organization_address',
                'value' => 'Kabupaten Tegal, Jawa Tengah',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Alamat organisasi',
            ],
            [
                'key' => 'organization_phone',
                'value' => '',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Nomor telepon organisasi',
            ],
            [
                'key' => 'welcome_text',
                'value' => 'Selamat Datang di Sistem Absensi PCNU Kabupaten Tegal',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Teks sambutan di station',
            ],
            [
                'key' => 'attendance_in_text',
                'value' => 'ABSENSI MASUK',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Teks untuk station absensi masuk',
            ],
            [
                'key' => 'attendance_out_text',
                'value' => 'ABSENSI KELUAR',
                'type' => 'string',
                'group' => 'application',
                'description' => 'Teks untuk station absensi keluar',
            ],

            // ===========================
            // Branding
            // ===========================
            [
                'key' => 'app_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'branding',
                'description' => 'Logo aplikasi (path)',
            ],
            [
                'key' => 'app_favicon',
                'value' => '',
                'type' => 'image',
                'group' => 'branding',
                'description' => 'Favicon aplikasi (path)',
            ],
            [
                'key' => 'primary_color',
                'value' => '#15803D',
                'type' => 'color',
                'group' => 'branding',
                'description' => 'Warna utama aplikasi',
            ],
            [
                'key' => 'secondary_color',
                'value' => '#166534',
                'type' => 'color',
                'group' => 'branding',
                'description' => 'Warna sekunder aplikasi',
            ],
            [
                'key' => 'banner_image',
                'value' => '',
                'type' => 'image',
                'group' => 'branding',
                'description' => 'Gambar banner station (path)',
            ],

            // ===========================
            // Attendance
            // ===========================
            [
                'key' => 'duplicate_window',
                'value' => '30',
                'type' => 'integer',
                'group' => 'attendance',
                'description' => 'Jendela duplikat absensi (detik)',
            ],

            // ===========================
            // Station
            // ===========================
            [
                'key' => 'heartbeat_interval',
                'value' => '30',
                'type' => 'integer',
                'group' => 'station',
                'description' => 'Interval heartbeat station (detik)',
            ],
            [
                'key' => 'station_idle_timeout',
                'value' => '3',
                'type' => 'integer',
                'group' => 'station',
                'description' => 'Timeout idle station setelah absensi berhasil (detik)',
            ],
            [
                'key' => 'station_online_threshold',
                'value' => '2',
                'type' => 'integer',
                'group' => 'station',
                'description' => 'Threshold ONLINE station berdasarkan last_seen_at (menit)',
            ],

            // ===========================
            // Backup
            // ===========================
            [
                'key' => 'backup_schedule',
                'value' => 'daily',
                'type' => 'string',
                'group' => 'backup',
                'description' => 'Jadwal backup otomatis',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('✓ Settings berhasil dibuat: ' . count($settings) . ' pengaturan.');
    }
}
