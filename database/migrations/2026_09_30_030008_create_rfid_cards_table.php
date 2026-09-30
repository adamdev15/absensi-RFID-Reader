<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RFID Cards — Tabel kartu RFID
 * DATABASE.md section 17, 18, 19, 20, 21
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rfid_cards', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 100)->unique();   // UID dinormalisasi: uppercase no spaces
            $table->foreignId('participant_id')->nullable()->constrained('participants')->nullOnDelete();
            $table->string('status', 30)->default('UNASSIGNED');  // ACTIVE | UNASSIGNED | DISABLED

            $table->timestamp('registered_at')->nullable();
            $table->timestamp('unregistered_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->foreignId('last_station_id')->nullable()->constrained('stations')->nullOnDelete();

            // JSON metadata — reader type, manufacturer, dll
            $table->json('metadata')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes — DATABASE.md section 46
            $table->index('participant_id');
            $table->index('status');
            $table->index('last_used_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rfid_cards');
    }
};
