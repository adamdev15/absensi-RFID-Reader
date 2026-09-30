<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Station Tokens — Token autentikasi station agent
 * DATABASE.md section 28
 * PRD: token secure, revocable, hashable
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('station_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained('stations')->cascadeOnDelete();
            $table->string('token_hash', 255)->nullable();   // hash dari token asli (opsional)
            $table->string('plain_token', 255)->unique();    // token raw untuk api dan UI
            $table->string('name', 100)->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();

            $table->index('token_hash');
            $table->index('station_id');
            $table->index('revoked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('station_tokens');
    }
};
