<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $fillable = [
        'check_in',
        'check_out',
        'jml_tamu',
        'kamar_id',
        'user_id',
        'total_harga',
        'malam',
        'status_pembayaran',
        'kode_pesanan', // Tambahkan ini
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode_pesanan = self::generateUniqueCode();
        });
    }

    private static function generateUniqueCode()
    {
        do {
            $code = strtoupper(str::random(8));
        } while (self::where('kode_pesanan', $code)->exists());

        return $code;
    }
    public function kamar(){
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
