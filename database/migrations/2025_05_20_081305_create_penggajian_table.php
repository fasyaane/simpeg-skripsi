<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('penggajian', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pegawai_id');
        $table->string('periode'); // bisa format "Mei 2025"
        $table->integer('gaji_pokok');
        $table->integer('tunjangan')->nullable();
        $table->integer('potongan')->nullable();
        $table->integer('total_gaji');
        $table->timestamps();

        // foreign key ke pegawai
        $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
