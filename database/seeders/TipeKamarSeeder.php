<?php

namespace Database\Seeders;

use App\Models\Tipe_Kamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Tipe_Kamar::create([
            'nama_kamar' => 'Deluxe Room',
            'harga' => 1000000,
            'fasilitas' => '<li>tipe kasur: <span>King-size bed (200x200 cm)</span></li>
                            <li>Kamar Mandi: <span>Shower</span></li>
                            <li>Ukuran: <span>40-sqm</span></li>
                            <li>View: <span>Garden</span></li>',
            'gambar_kamar' => 'public/gambar_kamar/uxepbfQti5akewOzXvoqzwDLjVCCs7fgAIdCZmd8.jpg',
        ]);
        Tipe_Kamar::create([
            'nama_kamar' => 'Premier Room',
            'harga' => 1500000,
            'fasilitas' => '<li>tipe kasur: <span>King-size bed (200x200 cm)</span></li>
                            <li>Kamar Mandi: <span>Shower & bathtub</span></li>
                            <li>Ukuran: <span>50-sqm</span></li>
                            <li>View: <span>Sky</span></li>',
            'gambar_kamar' => 'public/gambar_kamar/Jnnb5oxBN9SNdgWNEZVrzYU0FcyFLTZ6KgAJ9L9S.jpg',
        ]);
        Tipe_Kamar::create([
            'nama_kamar' => 'Gallery Room',
            'harga' => 3000000,
            'fasilitas' => '<li>tipe kasur: <span>King-size bed (200x200 cm)</span></li>
                            <li>Kamar Mandi: <span>Shower & bathtub</span></li>
                            <li>Ukuran: <span>55-sqm</span></li>
                            <li>View: <span>Garden</span></li>',
            'gambar_kamar' => 'public/gambar_kamar/0eDaeHrqbjKZbVwyfevHtygq4u2J1FR9xxHepYP3.jpg',
        ]);
        Tipe_Kamar::create([
            'nama_kamar' => 'Family Suite Room',
            'harga' => 4000000,
            'fasilitas' => '<li>tipe kasur: <span>King-size bed (200x200 cm)</span></li>
                            <li>Kamar Mandi: <span>Shower & bathtub</span></li>
                            <li>Ukuran: <span>62-sqm</span></li>
                            <li>View: <span>Valley & Garden</span></li>',
            'gambar_kamar' => 'public/gambar_kamar/gaCfODazL4r0gKKXTLqEJbRtk6HCflcgXood4SvJ.jpg',
        ]);
    }
}
