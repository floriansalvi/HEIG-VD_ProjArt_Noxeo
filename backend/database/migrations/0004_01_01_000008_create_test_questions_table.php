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
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->integer('index')->default(0);
            $table->text('content');
            $table->integer('points_awarded')->default(1000);
            $table->timestamps();

            $table->unique(['index', 'test_id']);
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
