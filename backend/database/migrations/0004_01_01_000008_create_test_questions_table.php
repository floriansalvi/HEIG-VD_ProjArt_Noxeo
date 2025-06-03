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
        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('index')->default(0);
            $table->text('content');
            $table->integer('points_awarded')->default(1000);
            $table->foreignId('step_id')->constrained('steps')->onDelete('cascade');
            $table->foreignId('next_question')->nullable()->references('id')->on('test_questions')->onDelete('set null');
            $table->timestamps();

            $table->unique(['index', 'step_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_questions');
    }
};
