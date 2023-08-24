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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pembayaran');
            $table->integer('pembayaran_ke', false, true);
            $table->double('jumlah_pembayaran');
            $table->double('sisa_tagihan');
            $table->string('bukti_pembayaran', 100);
            $table->unsignedBigInteger('invoice_id');

            $table->foreign('invoice_id')->references('id')->on('invoice')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
