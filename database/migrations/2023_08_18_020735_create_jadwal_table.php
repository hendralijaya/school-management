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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('hari_id');
            $table->unsignedBigInteger('waktu_id');
            $table->enum('status', ['A', 'D'])->default('A');

            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajaran')->cascadeOnDelete();
            $table->foreign('guru_id')->references('id')->on('guru')->cascadeOnDelete();
            $table->foreign('ruang_id')->references('id')->on('ruang')->cascadeOnDelete();
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
            $table->foreign('hari_id')->references('id')->on('hari')->cascadeOnDelete();
            $table->foreign('waktu_id')->references('id')->on('waktu')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
