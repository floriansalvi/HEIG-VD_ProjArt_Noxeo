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
        Schema::create('test_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('step_id')->constrained('steps')->onDelete('cascade');
            $table->timestamp('attempt_date');
            $table->integer('score');
            $table->integer('time_bonus');
            $table->boolean('is_successful')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'step_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_progress');
    }
};
