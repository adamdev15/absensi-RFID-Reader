<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Stations — Tabel station absensi
 * DATABASE.md section 23, 24, 25, 26, 52
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('station_code', 50)->unique();
            $table->string('name', 100);
            $table->string('type', 20);           // IN | OUT
            $table->string('status', 30)->default('ACTIVE');  // ACTIVE | DISABLED

            // Device info (diupdate lewat heartbeat)
            $table->string('hostname', 255)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('mac_address', 50)->nullable();
            $table->string('agent_version', 50)->nullable();

            // Timestamps operasional
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('last_connected_at')->nullable();
            $table->timestamp('last_disconnected_at')->nullable();
            $table->timestamp('registered_at')->nullable();

            // JSON metadata — DATABASE.md section 52
            $table->json('metadata')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes — DATABASE.md section 46
            $table->index('type');
            $table->index('status');
            $table->index('last_seen_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
