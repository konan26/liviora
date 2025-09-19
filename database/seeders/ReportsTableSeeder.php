<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use Faker\Factory as Faker;

class ReportsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $reports = [
            [
                'report_id' => 1,
                'user_id' => 3, // Customer Satu
                'isi_laporan' => $faker->paragraph(3),
                'status' => 'pending',
                'tanggal_lapor' => now()->subDays(2),
            ],
            [
                'report_id' => 2,
                'user_id' => 4, // Customer Dua
                'isi_laporan' => $faker->paragraph(3),
                'status' => 'pending',
                'tanggal_lapor' => now()->subDays(1),
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}