<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'nama_menu' => 'Kopi Hitam',
            'kategori' => 'Kopi',
            'harga' => 15000,
        ]);

        Menu::create([
            'nama_menu' => 'Kopi Susu',
            'kategori' => 'Kopi',
            'harga' => 18000,
        ]);

        Menu::create([
            'nama_menu' => 'Cappuccino',
            'kategori' => 'Kopi',
            'harga' => 22000,
        ]);

        Menu::create([
            'nama_menu' => 'Teh Hangat',
            'kategori' => 'Minuman',
            'harga' => 10000,
        ]);

        Menu::create([
            'nama_menu' => 'Es Jeruk',
            'kategori' => 'Minuman',
            'harga' => 12000,
        ]);

        Menu::create([
            'nama_menu' => 'Roti Bakar',
            'kategori' => 'Makanan',
            'harga' => 15000,
        ]);

        Menu::create([
            'nama_menu' => 'Nasi Goreng',
            'kategori' => 'Makanan',
            'harga' => 25000,
        ]);

        Menu::create([
            'nama_menu' => 'Sandwich',
            'kategori' => 'Makanan',
            'harga' => 20000,
        ]);
    }
}
