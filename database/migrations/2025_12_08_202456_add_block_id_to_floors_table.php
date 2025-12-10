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
            $table->foreignId('block_id')->nullable()->after('id')->constrained('blocks')->nullOnDelete();
            $table->dropUnique(['floor_number']); // Önce unique constraint'i kaldır
        });
        
        // Blok bazlı unique constraint ekle
        Schema::table('floors', function (Blueprint $table) {
            $table->unique(['block_id', 'floor_number']); // Aynı blokta aynı kat numarası olamaz
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('floors', function (Blueprint $table) {
            $table->dropForeign(['block_id']);
            $table->dropUnique(['block_id', 'floor_number']);
            $table->dropColumn('block_id');
            $table->unique('floor_number'); // Eski unique constraint'i geri ekle
        });
    }
};
