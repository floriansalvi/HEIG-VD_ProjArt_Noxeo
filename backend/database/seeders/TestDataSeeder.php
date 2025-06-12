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

        $question1 = TestQuestion::insert([
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

        // 

        $question2 = TestQuestion::insert([
            'id' => 2,
            'test_id' => 1,
            'index' => 1,
            'content' => 'Where was the Breitling compagny founded ?',
            'points_awarded' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice5 = TextChoice::insert([
            'id' => 5,
            'content' => 'Geneva',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice6 = TextChoice::insert([
            'id' => 6,
            'content' => 'La Chaux-de-Fonds',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice7 = TextChoice::insert([
            'id' => 7,
            'content' => 'Saint-Imier',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice8 = TextChoice::insert([
            'id' => 8,
            'content' => 'Lausanne',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice5 = Choice::insert([
            'id' => 5,
            'test_question_id' => 2,
            'is_correct' => false,
            'choiceable_id' => 5,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice6 = Choice::insert([
            'id' => 6,
            'test_question_id' => 2,
            'is_correct' => false,
            'choiceable_id' => 6,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice7 = Choice::insert([
            'id' => 7,
            'test_question_id' => 2,
            'is_correct' => true,
            'choiceable_id' => 7,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice8 = Choice::insert([
            'id' => 8,
            'test_question_id' => 2,
            'is_correct' => false,
            'choiceable_id' => 8,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //

         $question3 = TestQuestion::insert([
            'id' => 3,
            'test_id' => 1,
            'index' => 2,
            'content' => 'When was the Breitling compagny founded ?',
            'points_awarded' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice9 = TextChoice::insert([
            'id' => 9,
            'content' => '1924',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice10 = TextChoice::insert([
            'id' => 10,
            'content' => '1892',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice11 = TextChoice::insert([
            'id' => 11,
            'content' => '1904',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $textChoice12 = TextChoice::insert([
            'id' => 12,
            'content' => '1884',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice9 = Choice::insert([
            'id' => 9,
            'test_question_id' => 3,
            'is_correct' => false,
            'choiceable_id' => 9,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice10 = Choice::insert([
            'id' => 10,
            'test_question_id' => 3,
            'is_correct' => false,
            'choiceable_id' => 10,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice11 = Choice::insert([
            'id' => 11,
            'test_question_id' => 3,
            'is_correct' => false,
            'choiceable_id' => 11,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $choice12 = Choice::insert([
            'id' => 12,
            'test_question_id' => 3,
            'is_correct' => true,
            'choiceable_id' => 12,
            'choiceable_type' => TextChoice::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}