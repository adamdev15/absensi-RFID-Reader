<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Station User — Pivot table user-station assignment
 * DATABASE.md section 27
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('station_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained('stations')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();

            // Unique: satu user hanya bisa assign ke satu station per waktu yang sama
            $table->unique(['station_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('station_user');
    }
};
