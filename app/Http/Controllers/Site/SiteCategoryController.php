<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class SiteCategoryController extends Controller
{
  public function show(Category $parent, ?Category $child = null)
  {
      $parents = Category::whereNull('parent_id')
          ->where('is_active', 1)
          ->orderBy('sort_order')
          ->get();

      // Seçili üst kategori
      $currentParent = $parent->load('children');

      // Alt kategori seçimi
      if (!$child) {
          $currentChild = $currentParent->children->first();
      } else {
          $currentChild = $currentParent->children->firstWhere('id', $child->id);
      }

      $products = $currentChild
          ? $currentChild->products()->latest()->paginate(12)
          : collect();

      // Sepetteki ürünleri ve miktarlarını çek
      $cartItems = collect();
      $roomNumber = Session::get('room_number');
      
      if ($roomNumber) {
          $cart = Cart::where('room_number', $roomNumber)->first();
          if ($cart) {
              $cartItems = $cart->items()
                  ->whereIn('product_id', $products->pluck('id'))
                  ->with('product')
                  ->get()
                  ->keyBy('product_id');
          }
      }

      return view('site.category', compact(
          'parents',
          'currentParent',
          'currentChild',
          'products',
          'cartItems'
      ));
  }
}
