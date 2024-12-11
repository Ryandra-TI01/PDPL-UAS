<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use App\Models\Kamar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        // Pastikan untuk mengosongkan tabel pemesanan terlebih dahulu jika perlu
        // DB::table('pemesanan')->truncate();

        $faker = Faker::create();
        $totalPemesanan = 50;

        for ($i = 0; $i < $totalPemesanan; $i++) {
            // Random values sesuai dengan spesifikasi
            $malam = $faker->numberBetween(1, 5);
            $checkInDate = Carbon::create(2024, 7, $faker->numberBetween(1, 13));
            $checkOutDate = $checkInDate->copy()->addDays($malam);
            $kamarId = $faker->numberBetween(1, 100);
            $userId = $faker->numberBetween(6, 45);

            // Cari kamar yang tersedia untuk tipe kamar tertentu
            $kamar = Kamar::find($kamarId);

            // Total harga berdasarkan jumlah malam dan harga kamar per malam
            $totalHarga = $kamar->tipe_kamar->harga * $malam;

            // Buat kode pemesanan unik
            $kodePemesanan = strtoupper($faker->unique()->lexify('???????'));

            // Buat pemesanan
            Pemesanan::create([
                'check_in' => $checkInDate,
                'check_out' => $checkOutDate,
                'kamar_id' => $kamarId,
                'created_at' => $checkInDate->copy()->addDays($faker->numberBetween(0, 12)),
                'user_id' => $userId,
                'total_harga' => $totalHarga,
                'malam' => $malam,
                'status_pembayaran' => 'settlement',
                'kode_pesanan' => $kodePemesanan,
            ]);
        }
    }
}

