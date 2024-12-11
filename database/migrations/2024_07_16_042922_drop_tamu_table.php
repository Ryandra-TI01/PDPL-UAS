<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTamuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tamu');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Jika Anda ingin mengembalikan tabel tamu, Anda bisa menambahkan definisi tabel di sini
        Schema::create('tamu', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}
