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
            $table->string('code', 3)->unique(); // TRY, USD, EUR, GBP
            $table->string('symbol'); // ₺, $, €, £
            $table->string('name'); // Türk Lirası, US Dollar, Euro
            $table->decimal('exchange_rate', 10, 4)->default(1.0000); // Döviz kuru (TRY'ye göre)
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->integer('decimal_places')->default(2);
            $table->integer('sort_order')->default(0);
            $table->timestamp('last_updated_at')->nullable(); // Son güncelleme zamanı
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
