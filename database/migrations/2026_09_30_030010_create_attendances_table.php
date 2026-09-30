<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Attendances — Tabel absensi utama
 * DATABASE.md section 29, 30, 31, 32, 33, 34, 35, 37, 49, 50
 * PRD section 22
 *
 * PENTING: attendance tidak boleh dihapus (no soft deletes)
 * Attendance menggunakan snapshot fields untuk histori
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // Idempotency key — DATABASE.md section 30
            $table->char('attendance_uuid', 36)->unique();
            $table->string('attendance_code', 50)->unique();

            // Relations
            $table->foreignId('participant_id')->constrained('participants')->restrictOnDelete();
            $table->foreignId('rfid_card_id')->nullable()->constrained('rfid_cards')->nullOnDelete();
            $table->foreignId('station_id')->constrained('stations')->restrictOnDelete();

            // Attendance data
            $table->string('type', 10);              // IN | OUT
            $table->string('rfid_uid', 100);         // UID snapshot saat transaksi
            $table->timestamp('attendance_at');

            // Storage paths
            $table->string('participant_photo_path', 500)->nullable();
            $table->string('capture_path', 500)->nullable();

            // Status & source
            $table->string('status', 30);            // SUCCESS | REJECTED | DUPLICATE | PENDING_SYNC | SYNCED
            $table->string('source', 20);            // ONLINE | OFFLINE
            $table->timestamp('synced_at')->nullable();

            // Historical snapshot fields — DATABASE.md section 50
            $table->string('participant_name_snapshot', 255)->nullable();
            $table->string('participant_code_snapshot', 50)->nullable();
            $table->string('utusan_name_snapshot', 255)->nullable();
            $table->string('jabatan_name_snapshot', 255)->nullable();
            $table->string('mwcnu_name_snapshot', 255)->nullable();
            $table->string('station_name_snapshot', 255)->nullable();

            // JSON metadata — camera info, dll
            $table->json('metadata')->nullable();

            $table->timestamps();

            // Indexes — DATABASE.md section 35
            $table->index('participant_id');
            $table->index('station_id');
            $table->index('rfid_card_id');
            $table->index('attendance_at');
            $table->index('type');
            $table->index('status');
            $table->index('source');
            $table->index('created_at');
            $table->index(['participant_id', 'attendance_at']);
            $table->index(['station_id', 'attendance_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
