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
        Schema::table('floors', function (Blueprint $table) {
            // Mevcut unique constraint'i kaldır
            $table->dropUnique(['floor_number']);
            
            // company_id ve floor_number birlikte unique yap
            $table->unique(['company_id', 'floor_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('floors', function (Blueprint $table) {
            // company_id ve floor_number unique constraint'ini kaldır
            $table->dropUnique(['company_id', 'floor_number']);
            
            // Eski unique constraint'i geri ekle
            $table->unique('floor_number');
        });
    }
};
