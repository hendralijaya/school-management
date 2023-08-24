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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->double('total_tagihan');
            $table->date('deadline_tagihan');
            $table->dateTime('tanggal_lunas')->nullable();
            $table->string('dokumen_invoice', 100);
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('biaya_sekolah_id');
            $table->unsignedBigInteger('diskon_id')->nullable();

            $table->foreign('siswa_id')->references('id')->on('siswa')->cascadeOnDelete();
            $table->foreign('biaya_sekolah_id')->references('id')->on('biaya_sekolah')->cascadeOnDelete();
            $table->foreign('diskon_id')->references('id')->on('diskon')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
