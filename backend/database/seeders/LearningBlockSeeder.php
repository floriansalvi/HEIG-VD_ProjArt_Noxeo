<?php

namespace Database\Seeders;

use App\Models\LearningBlock;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningBlock::insert([
            [
                'index' => 0,
                'module_id' => 1,
                'blockable_id' => 1,
                'blockable_type' => 'App\\Models\\TextBlock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'index' => 1,
                'module_id' => 1,
                'blockable_id' => 1,
                'blockable_type' => 'App\\Models\\ImageBlock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'index' => 2,
                'module_id' => 1,
                'blockable_id' => 2,
                'blockable_type' => 'App\\Models\\TextBlock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'index' => 3,
                'module_id' => 1,
                'blockable_id' => 1,
                'blockable_type' => 'App\\Models\\VideoBlock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
