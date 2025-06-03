<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_question_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('game_progress_id')->constrained('game_progress')->onDelete('cascade');
            $table->foreignId('game_question_id')->constrained('game_questions')->onDelete('cascade');
            $table->boolean('is_successful');
            $table->timestamps();

            $table->unique(
                ['user_id', 'game_progress_id', 'game_question_id'],
                'uq_gqp_user_gp_gq'
);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_question_progress');
    }
};
