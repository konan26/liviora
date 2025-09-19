<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Response;
use Faker\Factory as Faker;

class ResponsesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $responses = [
            [
                'response_id' => 1,
                'report_id' => 1,
                'user_id' => 1, // Admin
                'isi_tanggapan' => $faker->sentence(5),
                'tanggal_reply' => now(),
            ],
            [
                'response_id' => 2,
                'report_id' => 2,
                'user_id' => 2, // Seller
                'isi_tanggapan' => $faker->sentence(5),
                'tanggal_reply' => now(),
            ],
        ];

        foreach ($responses as $response) {
            Response::create($response);
        }
    }
}