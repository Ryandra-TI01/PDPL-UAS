<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_tlp' => '12345678',
            'role' => 'admin',
            'asal_kota'=>'depok',
            'password' => Hash::make('11111111'), // Jangan lupa meng-hash passwordnya
        ]);

        // Tambahkan 5 admin
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $this->generateEmail($faker),
                'no_tlp' => $faker->phoneNumber,
                'role' => 'admin',
                'asal_kota' => $faker->city,
                'password' => Hash::make('11111111'), // Password yang sama untuk semua user
            ]);
        }

        // Tambahkan 45 user
        for ($i = 0; $i < 45; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $this->generateEmail($faker),
                'no_tlp' => $faker->phoneNumber,
                'role' => 'user',
                'asal_kota' => $faker->city,
                'password' => Hash::make('11111111'), // Password yang sama untuk semua user
            ]);
        }
    }

    // Fungsi untuk mengubah email ke @gmail.com
    private function generateEmail($faker)
    {
        $username = $faker->unique()->userName; // Mendapatkan username yang unik
        return "{$username}@gmail.com";
    }
}
