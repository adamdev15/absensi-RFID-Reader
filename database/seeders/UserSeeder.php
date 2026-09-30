<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

/**
 * UserSeeder — Buat akun development default
 * PRD: development account superadmin
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ===========================
        // Superadmin — development account
        // PENTING: Ubah password setelah login pertama!
        // ===========================
        $superadmin = User::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Administrator',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );
        $superadmin->assignRole('superadmin');

        // ===========================
        // Admin — untuk testing
        // ===========================
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );
        $admin->assignRole('admin');

        // ===========================
        // Petugas — untuk testing station
        // ===========================
        $petugas = User::firstOrCreate(
            ['username' => 'petugas01'],
            [
                'name' => 'Petugas Station 01',
                'username' => 'petugas01',
                'email' => 'petugas01@gmail.com',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );
        $petugas->assignRole('petugas');

        $this->command->info('✓ Users berhasil dibuat:');
        $this->command->table(
            ['Username', 'Role', 'Password'],
            [
                ['superadmin', 'superadmin', 'password'],
                ['admin', 'admin', 'password'],
                ['petugas01', 'petugas', 'password'],
            ]
        );
        $this->command->warn('⚠️  Ubah password production sebelum deployment!');
    }
}
