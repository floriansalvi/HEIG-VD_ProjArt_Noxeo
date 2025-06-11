<?php

namespace Database\Seeders;

use App\Models\VideoBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoBlock::insert([
            [
                'id' => 1,
                'vid_path' => 'history.mp4',
                'description' => 'a placeholder video'
            ]
            ]);
    }
}