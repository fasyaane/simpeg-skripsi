<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawai_activity_pegawai', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pegawai_id')->constrained()->onDelete('cascade');
    $table->foreignId('pegawai_activity_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_activity_pegawai');
    }
};
