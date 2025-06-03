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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('address', 128);
            $table->string('zip_code', 32);
            $table->string('city', 64);
            $table->string('email', 64)->nullable();
            $table->string('phone', 32)->nullable();
            $table->foreignId('market_id')->nullable()->constrained('markets')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
