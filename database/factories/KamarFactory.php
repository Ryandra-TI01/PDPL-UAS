<?php

namespace Database\Factories;

use App\Models\Kamar;
use App\Models\Tipe_Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

class KamarFactory extends Factory
{
    protected $model = Kamar::class;

    public function definition()
    {
        return [
            'no_kamar' => null, // Ini akan diisi di seeder
            'status' => 'Tersedia',
            'id_tipe_kamar' => null, // Ini juga akan diisi di seeder
        ];
    }
}
