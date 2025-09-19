<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $products = [
            [
                'product_id' => 1,
                'nama_produk' => 'Kemeja Flanel Pria',
                'deskripsi' => $faker->sentence(10),
                'harga' => 150000.00,
                'stok' => 50,
                'kategori_id' => 1,
                'gambar_url' => 'products/kemeja_flanel.jpg',
                'user_id' => 2, // Seller Satu
            ],
            [
                'product_id' => 2,
                'nama_produk' => 'Dress Floral Wanita',
                'deskripsi' => $faker->sentence(10),
                'harga' => 250000.00,
                'stok' => 30,
                'kategori_id' => 2,
                'gambar_url' => 'products/dress_floral.jpg',
                'user_id' => 2,
            ],
            [
                'product_id' => 3,
                'nama_produk' => 'Topi Baseball',
                'deskripsi' => $faker->sentence(10),
                'harga' => 80000.00,
                'stok' => 100,
                'kategori_id' => 3,
                'gambar_url' => 'products/topi_baseball.jpg',
                'user_id' => 2,
            ],
            [
                'product_id' => 4,
                'nama_produk' => 'Sepatu Sneakers',
                'deskripsi' => $faker->sentence(10),
                'harga' => 350000.00,
                'stok' => 20,
                'kategori_id' => 4,
                'gambar_url' => 'products/sneakers.jpg',
                'user_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}