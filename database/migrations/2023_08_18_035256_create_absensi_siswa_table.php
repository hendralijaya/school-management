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
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->char('absen_masuk', 1);
            $table->char('absen_pulang', 1)->nullable();
            $table->timestamp('waktu_absen_masuk');
            $table->timestamp('waktu_absen_pulang')->nullable();
            $table->string("status", 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_siswa');
    }
};
