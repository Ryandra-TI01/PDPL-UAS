<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id(); 
            $table->date('check_in'); 
            $table->date('check_out'); 
            $table->integer('jml_tamu'); 
            $table->foreignId('kamar_id')->constrained('kamar')->onDelete('cascade');
            $table->foreignId('tamu_id')->constrained('tamu')->onDelete('cascade'); 
            // constrained = sebagai referensi dari foreignid/key dari table yang dijadikan referensi 
            //onDelete = Ketika data dihapus dari table referensi maka secara otomatis data yang dijadikan referensi akan terhapus
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
