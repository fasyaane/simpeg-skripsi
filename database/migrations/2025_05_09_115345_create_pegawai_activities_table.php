<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawai_activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_aktivitas');
            $table->text('deskripsi');
            $table->datetime('jam_mulai');
            $table->datetime('jam_selesai');
            $table->uuid('uuid');
            $table->string('qrcode_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_activities');
    }
};
