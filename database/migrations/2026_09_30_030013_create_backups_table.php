<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Backups — Tabel backup database
 * DATABASE.md section 44, 45
 * PRD section 30
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 255);
            $table->string('disk', 50)->default('local');
            $table->string('path', 500);
            $table->bigInteger('size')->nullable();       // bytes
            $table->string('type', 30)->default('MANUAL');  // MANUAL | SCHEDULED
            $table->string('status', 30)->default('PENDING');  // PENDING | SUCCESS | FAILED
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backups');
    }
};
