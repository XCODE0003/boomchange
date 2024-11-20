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
        Schema::table('currencies', function (Blueprint $table) {
            // Сначала удаляем старое поле
            $table->dropColumn('min_amount');
            
            // Создаем новое поле с нужной точностью
            $table->decimal('min_amount', 22, 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('currencies', function (Blueprint $table) {
            // В откате возвращаем старое определение
            $table->dropColumn('min_amount');
            $table->decimal('min_amount', 10, 12)->nullable();
        });
    }
};
