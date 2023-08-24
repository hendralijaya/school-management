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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 10);
            $table->enum('status', ['A', 'D'])->default('A');
            $table->unsignedBigInteger('tingkat_kelas_id');

            // Define foreign key relationship
            $table->foreign('tingkat_kelas_id')->references('id')->on('tingkat_kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
