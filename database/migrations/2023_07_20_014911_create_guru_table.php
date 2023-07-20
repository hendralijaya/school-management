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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->length(100);
            $table->string('no_wa')->length(15);
            $table->char('gender')->length(1);
            $table->date('tgl_bergabung');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->char('status')->length(1)->default('A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
