<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status'); 
    
        $categories = Category::query()
            ->where('company_id', Auth::user()->company_id)
            ->with(['user'])
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('slug', 'like', "%{$q}%");
                });
            })

            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END') 
            ->orderBy('sort_order') 
            ->paginate(10)
            ->withQueryString();
    
        return view('admin.category.categories', compact('categories', 'q', 'status'));
    }
    

    public function create()
    {
        $staff = User::where('company_id', Auth::user()->company_id)->orderBy('name')->get();
        return view('admin.category.add-category', compact('staff'));
    }

    public function edit($id)
    {
        $category = Category::where('company_id', Auth::user()->company_id)->findOrFail($id);
        $staff = User::where('company_id', Auth::user()->company_id)->orderBy('name')->get();
        return view('admin.category.edit-category', compact('category', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('company_id', Auth::user()->company_id)->findOrFail($id);

        $category->name = $request->input('category_name');
        $category->slug = \Str::slug($category->name);
        $category->description = $request->input('description');
        $category->is_active = $request->input('is_active', 0);
        $category->sort_order = $request->input('sort_order', 0);
        $category->user_id = $request->input('user_id');

        $category->save();

        return redirect()
            ->route('admin.categories.edit', $category->id)
            ->with('success', 'Kategori başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = \Str::slug($category->name);
        $category->description = $request->input('description');
        $category->sort_order = $request->input('sort_order', 0);
        $category->is_active = $request->input('is_active');
        $category->user_id = $request->input('user_id');
        $category->company_id = Auth::user()->company_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category->image_path = $path;
        }

        $category->save();

        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }

    public function destroy(Category $category)
    {
        if ($category->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu kategoriye erişim yetkiniz yok.');
        }
        $category->delete();
    
        return redirect()
            ->back()
            ->with('success', 'Kategori başarıyla silindi.');
    }
}
