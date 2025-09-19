<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user_id' => 1,
                'nama_lengkap' => 'Admin Liviora',
                'email' => 'admin@liviora.com',
                'password_hash' => Hash::make('password123'),
                'no_hp' => '081234567890',
                'role' => 'admin',
                'status' => 'aktif',
                'tanggal_daftar' => now(),
            ],
            [
                'user_id' => 2,
                'nama_lengkap' => 'Seller Satu',
                'email' => 'seller1@liviora.com',
                'password_hash' => Hash::make('password123'),
                'no_hp' => '081234567891',
                'role' => 'staff',
                'status' => 'aktif',
                'tanggal_daftar' => now(),
            ],
            [
                'user_id' => 3,
                'nama_lengkap' => 'Customer Satu',
                'email' => 'customer1@liviora.com',
                'password_hash' => Hash::make('password123'),
                'no_hp' => '081234567892',
                'role' => 'customer',
                'status' => 'aktif',
                'tanggal_daftar' => now(),
            ],
            [
                'user_id' => 4,
                'nama_lengkap' => 'Customer Dua',
                'email' => 'customer2@liviora.com',
                'password_hash' => Hash::make('password123'),
                'no_hp' => '081234567893',
                'role' => 'customer',
                'status' => 'aktif',
                'tanggal_daftar' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}