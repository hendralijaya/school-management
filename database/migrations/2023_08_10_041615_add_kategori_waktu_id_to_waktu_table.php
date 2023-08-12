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
        Schema::table('waktu', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_waktu_id')->nullable();

            $table->foreign('kategori_waktu_id')->references('id')->on('kategori_waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('waktu', function (Blueprint $table) {
            $table->dropForeign(['kategori_waktu_id']);
            $table->dropColumn('kategori_waktu_id');
        });
    }
};
