<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $totalKamar = 100;
        $tipeKamarCount = 4; // Total tipe kamar yang ada
        $kamarPerTipe = $totalKamar / $tipeKamarCount; // Jumlah kamar per tipe

        // Buat kamar untuk setiap tipe kamar
        for ($tipeId = 1; $tipeId <= $tipeKamarCount; $tipeId++) {
            for ($i = 1; $i <= $kamarPerTipe; $i++) {
                Kamar::factory()->create([
                    'no_kamar' => (($tipeId - 1) * $kamarPerTipe) + $i, // Penomoran kamar berurutan
                    'id_tipe_kamar' => $tipeId,
                ]);
            }
        }
    }
}
