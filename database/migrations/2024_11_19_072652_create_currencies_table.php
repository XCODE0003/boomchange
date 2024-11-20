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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->enum('type', ['fiat', 'crypto'])->default('fiat');
            $table->boolean('static_course')->default(false);
            $table->string('course')->nullable();
            $table->decimal('min_amount', 10, 2)->nullable();
            $table->string('coinmarketcap_id')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
