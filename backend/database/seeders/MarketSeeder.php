<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Market::insert([
            [
                'id' => 1,
                'name' => 'Heig',
                'img_path' => '/heig.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Switzerland',
                'img_path' => '/switzerlabd.jpg'
            ]
        ]);
    }
}
