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
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Category', 'Module', 'Specials']);
            $table->string('img_path', 128);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete(action: 'set null');
             $table->foreignId('module_id')->nullable()->constrained('modules')->onDelete(action: 'set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
