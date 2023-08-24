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
        Schema::create('libur', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hari_raya', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('kategori_hari_id');

            $table->foreign('kategori_hari_id')->references('id')->on('kategori_hari')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libur');
    }
};
