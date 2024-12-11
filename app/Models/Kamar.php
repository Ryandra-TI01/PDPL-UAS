<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $guarded = ['id'];    

    public function tipe_kamar(){
        return $this->belongsTo(Tipe_Kamar::class, 'id_tipe_kamar');
    }
    public function pemesanan(){
        return $this->hasMany(Pemesanan::class, 'kamar_id');
    }
}
