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
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Dibayar', 'Menunggu Konfirmasi','Pembayaran Tidak Berhasil','Pembayaran Berhasil'])->change();
            $table->string('bukti_transfer')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Lunas', 'Tidak Lunas'])->change();
            $table->dropColumn('bukti_transfer');
        });
    }
};
