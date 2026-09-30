<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Urutan seeder PENTING — jangan ubah!
     * 1. PermissionSeeder → buat roles & permissions dulu
     * 2. UserSeeder → butuh roles dari PermissionSeeder
     * 3. MasterDataSeeder → master data independen
     * 4. SettingSeeder → settings independen
     */
    public function run(): void
    {
        $this->command->info('=== PCNU Absensi — Database Seeder ===');

        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            MasterDataSeeder::class,
            SettingSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('✅ Seeding selesai!');
        $this->command->warn('⚠️  Ubah password production sebelum deployment!');
    }
}
