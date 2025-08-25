<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

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

      return view('site.category', compact(
          'parents',
          'currentParent',
          'currentChild',
          'products'
      ));
  }
}
