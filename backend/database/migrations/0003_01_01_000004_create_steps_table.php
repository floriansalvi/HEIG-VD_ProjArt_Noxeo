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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->integer('index')->default(0);
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->enum('type', ['Game', 'Test']);
            $table->foreignId('next_step')->nullable()->references('id')->on('steps')->onDelete('set null');
            $table->integer('max_time')->nullable();
            $table->timestamps();

            $table->unique(['index', 'module_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
