<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteHomeController extends Controller
{
   
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        return view('site.index', compact('categories'));
    }
    
}
