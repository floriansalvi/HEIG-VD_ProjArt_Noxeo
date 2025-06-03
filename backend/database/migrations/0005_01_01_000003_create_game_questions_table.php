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
        Schema::create('game_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->integer('index');
            $table->text('content');
            $table->integer('points_awarded')->default(100);
            $table->enum('type', ['association', 'blanks', 'order', 'mcq']);
            $table->nullableMorphs('answerable');
            $table->timestamps();

            $table->unique(['game_id', 'index']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_questions');
    }
};
