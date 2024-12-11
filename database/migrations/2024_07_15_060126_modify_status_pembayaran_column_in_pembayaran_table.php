<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusPembayaranColumnInPembayaranTable extends Migration
{
    public function up()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Lunas', 'Tidak Lunas'])->change();
        });
    }

    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Lunas', 'Tidak Lunas'])->change();
        });
    }
}
