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
        Schema::table('products', function (Blueprint $table) {
            // Mevcut unique constraint'i kaldır
            $table->dropUnique(['slug']);
            
            // company_id ve slug birlikte unique yap
            $table->unique(['company_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // company_id ve slug unique constraint'ini kaldır
            $table->dropUnique(['company_id', 'slug']);
            
            // Eski unique constraint'i geri ekle
            $table->unique('slug');
        });
    }
};
