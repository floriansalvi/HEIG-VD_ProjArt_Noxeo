<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Step;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\TextChoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $step = Step::insert([
            'id' => '1',
            'index' => 0,
            'module_id' => 1,
            'type' => 'Test',
            'next_step' => null,
            'max_time' => 120,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $test = Test::insert([
            'id' => 1,
            'step_id' => 1,
            'index' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $question = TestQuestion::insert([
            'id' => 1,
            'test_id' => 1,
            'index' => 0,
            'content' => 'Who founded the Breitling compagny ?',
            'points_awarded' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice1 = TextChoice::insert([
            'id' => 1,
            'content' => 'Richard Breitling',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice2 = TextChoice::insert([
            'id' => 2,
            'content' => 'Léon Breitling',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice3 = TextChoice::insert([
            'id' => 3,
            'content' => 'François Breitling',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice4 = TextChoice::insert([
            'id' => 4,
            'content' => 'Louis Breitling',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice1 = Choice::insert([
            'id' => 1,
            'test_question_id' => 1,
            'is_correct' => false,
            'choiceable_id' => 1,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice2 = Choice::insert([
            'id' => 2,
            'test_question_id' => 1,
            'is_correct' => true,
            'choiceable_id' => 2,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice3 = Choice::insert([
            'id' => 3,
            'test_question_id' => 1,
            'is_correct' => false,
            'choiceable_id' => 3,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice4 = Choice::insert([
            'id' => 4,
            'test_question_id' => 1,
            'is_correct' => false,
            'choiceable_id' => 4,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}