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
        Schema::create('absensi_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->text('materi_ajar');
            $table->text('keterangan');
            $table->string("dokumen_absen", 100);
            $table->date("tanggal_issued");
            $table->unsignedBigInteger('jadwal_id');

            $table->foreign('jadwal_id')->references('id')->on('jadwal')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_pertemuan');
    }
};
