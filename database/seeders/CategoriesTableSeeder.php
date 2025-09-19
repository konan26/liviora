<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['kategori_id' => 1, 'nama_kategori' => 'Pakaian Pria'],
            ['kategori_id' => 2, 'nama_kategori' => 'Pakaian Wanita'],
            ['kategori_id' => 3, 'nama_kategori' => 'Aksesoris'],
            ['kategori_id' => 4, 'nama_kategori' => 'Sepatu'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}