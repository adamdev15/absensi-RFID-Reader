<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MWCNU — Master data MWCNU
 * DATABASE.md section 16
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mwcnu', function (Blueprint $table) {
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
        Schema::dropIfExists('mwcnu');
    }
};
