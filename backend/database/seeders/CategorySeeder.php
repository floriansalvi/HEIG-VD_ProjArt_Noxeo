<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'id' => 1,
                'title' => 'Onboarding',
            ],
            [
                'id' => 2,
                'title' => 'Discovery',
            ],
            [
                'id' => 3,
                'title' => 'Novelties',
            ],[
                'id' => 4,
                'title' => 'Specials',
            ]
        ]);
    }
}