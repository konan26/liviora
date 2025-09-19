<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        $orderItems = [
            [
                'order_item_id' => 1,
                'order_id' => 1,
                'product_id' => 1, // Kemeja Flanel
                'jumlah' => 2,
                'harga_satuan' => 150000.00,
            ],
            [
                'order_item_id' => 2,
                'order_id' => 1,
                'product_id' => 2, // Dress Floral
                'jumlah' => 1,
                'harga_satuan' => 250000.00,
            ],
            [
                'order_item_id' => 3,
                'order_id' => 2,
                'product_id' => 3, // Topi Baseball
                'jumlah' => 2,
                'harga_satuan' => 80000.00,
            ],
        ];

        foreach ($orderItems as $item) {
            OrderItem::create($item);
        }
    }
}