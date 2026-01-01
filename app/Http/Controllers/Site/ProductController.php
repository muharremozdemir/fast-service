<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('category');
        
        // Company bilgisini al (room_number'dan)
        $company = null;
        $roomNumber = Session::get('room_number');
        if ($roomNumber) {
            $room = Room::where('room_number', $roomNumber)->first();
            if ($room && $room->company) {
                $company = $room->company;
            }
        }
        
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
        
        return view('site.product', compact('product', 'backUrl', 'company'));
    }
}
