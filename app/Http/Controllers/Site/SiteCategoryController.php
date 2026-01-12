<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Room;
use Illuminate\Support\Facades\Session;

class SiteCategoryController extends Controller
{
  public function show($parentCategory, ?Category $child = null)
  {
      $roomNumber = Session::get('room_number');

      $room = Room::where('room_number', $roomNumber)->first();

      $parentCategory = Category::query()
          ->where('company_id', $room->company_id)
          ->where('slug', $parentCategory)
          ->first();

      $parents = Category::whereNull('parent_id')
          ->where('is_active', 1)
          ->where('company_id', $room->company_id)
          ->orderBy('sort_order')
          ->get();

      // Seçili üst kategori
      $currentParent = $parentCategory->load('children');

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
      $company = null;

      $cart = Cart::where('room_number', $roomNumber)->first();
      if ($cart) {
          $cartItems = $cart->items()
              ->whereIn('product_id', $products->pluck('id'))
              ->with('product')
              ->get()
              ->keyBy('product_id');
      }

      return view('site.category', compact(
          'parents',
          'currentParent',
          'currentChild',
          'products',
          'cartItems',
          'company'
      ));
  }
}
