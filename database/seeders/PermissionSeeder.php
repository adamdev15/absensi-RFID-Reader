<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * PermissionSeeder — Seeder roles dan permissions
 * DATABASE.md section 6, 7, 8, 9
 */
class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ===========================
        // Buat semua permissions
        // ===========================
        $permissions = [
            // Dashboard
            'dashboard.view',

            // Participants
            'participants.view',
            'participants.create',
            'participants.update',
            'participants.delete',

            // Master data
            'utusan.manage',
            'positions.manage',
            'mwcnu.manage',

            // RFID
            'rfid.view',
            'rfid.register',
            'rfid.update',
            'rfid.delete',

            // Stations
            'stations.view',
            'stations.manage',

            // Station agent
            'station.access',
            'station.view',

            // Attendance
            'attendance.view',
            'attendance.create',
            'attendance.delete',

            // Logs
            'logs.view',

            // Reports
            'reports.view',
            'reports.export',

            // Settings
            'settings.view',
            'settings.update',

            // Backup
            'backup.create',
            'backup.restore',
            'backup.delete',

            // Users
            'users.manage',
            'roles.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ===========================
        // Buat roles dan assign permissions
        // ===========================

        // Superadmin — akses penuh
        $superadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $superadmin->syncPermissions(Permission::all());

        // Admin — akses operasional
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'dashboard.view',
            'participants.view',
            'participants.create',
            'participants.update',
            'rfid.view',
            'rfid.register',
            'rfid.update',
            'stations.view',
            'attendance.view',
            'logs.view',
            'reports.view',
            'reports.export',
        ]);

        // Petugas — akses station only
        $petugas = Role::firstOrCreate(['name' => 'petugas', 'guard_name' => 'web']);
        $petugas->syncPermissions([
            'station.access',
            'station.view',
            'attendance.create',
            'attendance.view',
        ]);

        $this->command->info('✓ Roles dan permissions berhasil dibuat.');
        $this->command->table(
            ['Role', 'Jumlah Permission'],
            [
                ['superadmin', $superadmin->permissions()->count()],
                ['admin', $admin->permissions()->count()],
                ['petugas', $petugas->permissions()->count()],
            ]
        );
    }
}
