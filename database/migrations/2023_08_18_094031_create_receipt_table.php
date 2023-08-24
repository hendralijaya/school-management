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
        Schema::create('receipt', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_terbit');
            $table->string('dokumen_receipt', 100);
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('pembayaran_id');

            $table->foreign('invoice_id')->references('id')->on('invoice')->cascadeOnDelete();
            $table->foreign('pembayaran_id')->references('id')->on('pembayaran')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt');
    }
};
