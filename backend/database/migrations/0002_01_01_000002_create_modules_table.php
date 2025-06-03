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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title', 64);
            $table->string('img_path', 128)->nullable();
            $table->date('availability_date')->nullable();
            $table->integer('index')->default(0);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['index', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
