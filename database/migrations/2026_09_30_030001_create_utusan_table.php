<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Utusan — Master data utusan / delegasi
 * DATABASE.md section 14
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utusan', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('status', 30)->default('ACTIVE');
            $table->softDeletes();
            $table->timestamps();

            $table->index('status');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utusan');
    }
};
