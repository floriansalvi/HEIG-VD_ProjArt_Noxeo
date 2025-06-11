<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::insert([
            [
                'id' => 1,
                'title' => 'History',
                'img_path' => 'history.jpg',
                'availability_date' => null,
                'index' => 0,
                'category_id' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Inspiration and positionning',
                'img_path' => 'inpiration_and_positionning.jpg',
                'availability_date' => null,
                'index' => 1,
                'category_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Understanding the collection',
                'img_path' => 'understanding_the_collection.jpg',
                'availability_date' => null,
                'index' => 2,
                'category_id' => 1,
            ],
            [
                'id' => 4,
                'title' => 'Storytelling',
                'img_path' => 'storytelling.jpg',
                'availability_date' => null,
                'index' => 3,
                'category_id' => 1,
            ],
            [
                'id' => 5,
                'title' => 'Core collections',
                'img_path' => 'core_collection.jpg',
                'availability_date' => null,
                'index' => 4,
                'category_id' => 1,
            ],
        ]);
    }
}
