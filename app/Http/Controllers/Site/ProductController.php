<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('category');
        
        // Kategori sayfasına geri dönmek için kategori bilgisini hazırla
        $backUrl = url()->previous();
        if ($product->category) {
            $category = $product->category;
            // Eğer kategori bir parent'a sahipse, parent ve child ile route oluştur
            if ($category->parent_id) {
                $parent = $category->parent;
                $backUrl = route('site.category', ['parent' => $parent->slug, 'child' => $category->slug]);
            } else {
                // Eğer kategori parent ise, sadece parent ile route oluştur
                $backUrl = route('site.category', ['parent' => $category->slug]);
            }
        }
        
        return view('site.product', compact('product', 'backUrl'));
    }
}
