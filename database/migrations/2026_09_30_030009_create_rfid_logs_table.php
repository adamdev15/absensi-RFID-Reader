<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RFID Logs — Log aktivitas RFID
 * DATABASE.md section 22
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rfid_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfid_card_id')->nullable()->constrained('rfid_cards')->nullOnDelete();
            $table->foreignId('participant_id')->nullable()->constrained('participants')->nullOnDelete();
            $table->foreignId('station_id')->nullable()->constrained('stations')->nullOnDelete();
            $table->string('uid', 100);
            $table->string('event_type', 50);  // SCAN | REGISTER | UNREGISTER | ASSIGN | UNASSIGN | REJECT
            $table->timestamp('event_at');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index('uid');
            $table->index('rfid_card_id');
            $table->index('event_type');
            $table->index('event_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rfid_logs');
    }
};
