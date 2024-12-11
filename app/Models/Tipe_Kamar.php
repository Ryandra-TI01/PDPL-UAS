<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe_Kamar extends Model
{
    use HasFactory;
    protected $table = 'tipe_kamar';
    protected $guarded = ['id'];
    public function kamar(){
        return $this->hasMany(Kamar::class, 'id_tipe_kamar');
    }
}
