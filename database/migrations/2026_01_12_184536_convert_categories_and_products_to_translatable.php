<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Categories tablosundaki mevcut string verileri JSON formatına dönüştür
        $categories = DB::table('categories')->get();
        
        foreach ($categories as $category) {
            $updates = [];
            
            // Name alanını kontrol et ve JSON formatına dönüştür
            if (!empty($category->name)) {
                // Eğer zaten JSON formatındaysa, olduğu gibi bırak
                $decoded = json_decode($category->name, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // String formatında, JSON'a dönüştür
                    $updates['name'] = json_encode([
                        'tr' => $category->name,
                        'en' => $category->name,
                        'de' => $category->name,
                        'ru' => $category->name,
                    ], JSON_UNESCAPED_UNICODE);
                }
            }
            
            // Description alanını kontrol et ve JSON formatına dönüştür
            if (!empty($category->description)) {
                $decoded = json_decode($category->description, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // String formatında, JSON'a dönüştür
                    $updates['description'] = json_encode([
                        'tr' => $category->description,
                        'en' => $category->description,
                        'de' => $category->description,
                        'ru' => $category->description,
                    ], JSON_UNESCAPED_UNICODE);
                }
            }
            
            if (!empty($updates)) {
                DB::table('categories')
                    ->where('id', $category->id)
                    ->update($updates);
            }
        }
        
        // Products tablosundaki mevcut string verileri JSON formatına dönüştür
        $products = DB::table('products')->get();
        
        foreach ($products as $product) {
            $updates = [];
            
            // Name alanını kontrol et ve JSON formatına dönüştür
            if (!empty($product->name)) {
                $decoded = json_decode($product->name, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // String formatında, JSON'a dönüştür
                    $updates['name'] = json_encode([
                        'tr' => $product->name,
                        'en' => $product->name,
                        'de' => $product->name,
                        'ru' => $product->name,
                    ], JSON_UNESCAPED_UNICODE);
                }
            }
            
            // Description alanını kontrol et ve JSON formatına dönüştür
            if (!empty($product->description)) {
                $decoded = json_decode($product->description, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // String formatında, JSON'a dönüştür
                    $updates['description'] = json_encode([
                        'tr' => $product->description,
                        'en' => $product->description,
                        'de' => $product->description,
                        'ru' => $product->description,
                    ], JSON_UNESCAPED_UNICODE);
                }
            }
            
            if (!empty($updates)) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Geri alma işlemi - JSON verilerini string'e dönüştür (Türkçe değerini al)
        $categories = DB::table('categories')->get();
        
        foreach ($categories as $category) {
            $updates = [];
            
            if (!empty($category->name)) {
                $decoded = json_decode($category->name, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $updates['name'] = $decoded['tr'] ?? $decoded['en'] ?? reset($decoded);
                }
            }
            
            if (!empty($category->description)) {
                $decoded = json_decode($category->description, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $updates['description'] = $decoded['tr'] ?? $decoded['en'] ?? reset($decoded);
                }
            }
            
            if (!empty($updates)) {
                DB::table('categories')
                    ->where('id', $category->id)
                    ->update($updates);
            }
        }
        
        $products = DB::table('products')->get();
        
        foreach ($products as $product) {
            $updates = [];
            
            if (!empty($product->name)) {
                $decoded = json_decode($product->name, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $updates['name'] = $decoded['tr'] ?? $decoded['en'] ?? reset($decoded);
                }
            }
            
            if (!empty($product->description)) {
                $decoded = json_decode($product->description, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $updates['description'] = $decoded['tr'] ?? $decoded['en'] ?? reset($decoded);
                }
            }
            
            if (!empty($updates)) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update($updates);
            }
        }
    }
};
