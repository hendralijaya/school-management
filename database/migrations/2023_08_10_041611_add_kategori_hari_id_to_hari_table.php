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
        Schema::table('hari', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_hari_id');

            $table->foreign('kategori_hari_id')->references('id')->on('kategori_hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hari', function (Blueprint $table) {
            $table->dropForeign(['kategori_hari_id']);
            $table->dropColumn('kategori_hari_id');
        });
    }
};
