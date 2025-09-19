<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'order_id' => 1,
                'user_id' => 3, // Customer Satu
                'tanggal_order' => now()->subDays(3),
                'status_order' => 'pending',
                'total_harga' => 400000.00,
            ],
            [
                'order_id' => 2,
                'user_id' => 4, // Customer Dua
                'tanggal_order' => now()->subDays(1),
                'status_order' => 'paid',
                'total_harga' => 150000.00,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}