<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Participants — Tabel peserta utama
 * DATABASE.md section 10, 11, 12, 13
 * PRD.md section 11
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('participant_code', 50)->unique();
            $table->string('name', 255);
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender', 20)->nullable();  // L/P atau MALE/FEMALE

            // Foreign keys — master data
            $table->foreignId('utusan_id')->nullable()->constrained('utusan')->nullOnDelete();
            $table->foreignId('jabatan_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->foreignId('mwcnu_id')->nullable()->constrained('mwcnu')->nullOnDelete();

            $table->string('photo_path', 500)->nullable();
            $table->string('mandate_letter_path', 500)->nullable();
            $table->string('organization', 255)->nullable();
            $table->string('status', 30)->default('ACTIVE');

            // Legacy/cache field — DATABASE.md note: RFID utama di rfid_cards
            $table->string('rfid_uid', 100)->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes — DATABASE.md section 46
            $table->index('name');
            $table->index('utusan_id');
            $table->index('jabatan_id');
            $table->index('mwcnu_id');
            $table->index('status');
            $table->index('rfid_uid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
