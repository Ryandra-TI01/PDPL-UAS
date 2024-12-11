<?php

namespace Database\Seeders;

use App\Models\Tipe_Kamar;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TipeKamarSeeder::class);
        $this->call(KamarSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PemesananSeeder::class);
    }
}