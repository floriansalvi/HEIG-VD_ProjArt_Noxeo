<?php

namespace Database\Seeders;

use App\Models\ImageBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageBlock::insert([
            [
                'id' => 1,
                'img_path' => 'history.jpg',
                'alt_txt' => 'a placeholder picture'
            ]
            ]);
    }
}
