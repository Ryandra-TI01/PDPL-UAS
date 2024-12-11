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
        Schema::dropIfExists('pembayaran');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->enum('status_pembayaran', ['Belum Dibayar', 'Menunggu Konfirmasi','Pembayaran Tidak Berhasil','Pembayaran Berhasil'])->change();
            $table->foreignId('pemesanan_id')->constrained('pemesanan')->onDelete('cascade');
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }
};
