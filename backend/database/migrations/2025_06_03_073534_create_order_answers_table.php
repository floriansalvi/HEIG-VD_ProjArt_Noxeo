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
        Schema::create('order_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_question_id')->constrained('game_questions')->onDelete('cascade');
            $table->text('content');
            $table->integer('index')->default(0);
            $table->timestamps();

            $table->unique(['game_question_id', 'index']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_answers');
    }
};
