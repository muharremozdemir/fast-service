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
            ->with(['users', 'parent'])
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
        $staff = User::where('company_id', Auth::user()->company_id)->orderBy('name_surname')->get();
        $parentCategories = Category::where('company_id', Auth::user()->company_id)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        return view('admin.category.add-category', compact('staff', 'parentCategories'));
    }

    public function edit($id)
    {
        $category = Category::where('company_id', Auth::user()->company_id)->with('users')->findOrFail($id);
        $staff = User::where('company_id', Auth::user()->company_id)->orderBy('name_surname')->get();
        // Üst kategori seçenekleri: Kendisi ve alt kategorileri hariç
        $parentCategories = Category::where('company_id', Auth::user()->company_id)
            ->whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('name')
            ->get();
        return view('admin.category.edit-category', compact('category', 'staff', 'parentCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name_tr' => 'required_without:category_name|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_de' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'category_name' => 'required_without:name_tr|string|max:255', // Geriye dönük uyumluluk
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_de' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description' => 'nullable|string', // Geriye dönük uyumluluk
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|in:0,1',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = Category::where('company_id', Auth::user()->company_id)->findOrFail($id);

        // Üst kategori kontrolü: kendi şirketine ait olmalı ve kendisi olmamalı
        $parentId = $request->input('parent_id');
        if (!empty($parentId)) {
            $parentCategory = Category::where('company_id', Auth::user()->company_id)
                ->where('id', $parentId)
                ->first();
            if (!$parentCategory || $parentId == $id) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Geçersiz üst kategori seçildi.');
            }
        } else {
            $parentId = null; // Ana kategori
        }

        // Seçilen kullanıcıların şirkete ait olduğunu kontrol et
        $userIds = $request->input('user_ids', []);
        if (!empty($userIds)) {
            $invalidUsers = User::whereIn('id', $userIds)
                ->where('company_id', '!=', Auth::user()->company_id)
                ->exists();
            if ($invalidUsers) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Seçilen personellerden biri veya birkaçı sizin şirketinize ait değil.');
            }
        }

        // Çoklu dil desteği için name ve description alanlarını JSON formatına dönüştür
        $nameTranslations = [
            'tr' => $request->input('name_tr', ''),
            'en' => $request->input('name_en', ''),
            'de' => $request->input('name_de', ''),
            'ru' => $request->input('name_ru', ''),
        ];
        $descriptionTranslations = [
            'tr' => $request->input('description_tr', ''),
            'en' => $request->input('description_en', ''),
            'de' => $request->input('description_de', ''),
            'ru' => $request->input('description_ru', ''),
        ];
        
        // Eğer eski format kullanılıyorsa (geriye dönük uyumluluk)
        if ($request->has('category_name') && !$request->has('name_tr')) {
            $nameTranslations['tr'] = $request->input('category_name');
            $descriptionTranslations['tr'] = $request->input('description', '');
        }
        
        $category->name = $nameTranslations;
        $category->slug = \Str::slug($nameTranslations['tr'] ?: $nameTranslations['en'] ?: 'category');
        $category->parent_id = $parentId;
        $category->description = $descriptionTranslations;
        $category->is_active = (int) $request->input('is_active', 0);
        $category->sort_order = (int) $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            // Eski görseli sil
            if ($category->image_path) {
                \Storage::disk('public')->delete($category->image_path);
            }
            $path = $request->file('image')->store('categories', 'public');
            $category->image_path = $path;
        }

        $category->save();

        // Görevlileri güncelle
        $category->users()->sync($userIds);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name_tr' => 'required_without:name|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_de' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'name' => 'required_without:name_tr|string|max:255', // Geriye dönük uyumluluk
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_de' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description' => 'nullable|string', // Geriye dönük uyumluluk
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|in:0,1',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Üst kategori kontrolü: kendi şirketine ait olmalı
        $parentId = $request->input('parent_id');
        if (!empty($parentId)) {
            $parentCategory = Category::where('company_id', Auth::user()->company_id)
                ->where('id', $parentId)
                ->first();
            if (!$parentCategory) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Geçersiz üst kategori seçildi.');
            }
        } else {
            $parentId = null; // Ana kategori
        }

        // Seçilen kullanıcıların şirkete ait olduğunu kontrol et
        $userIds = $request->input('user_ids', []);
        if (!empty($userIds)) {
            $invalidUsers = User::whereIn('id', $userIds)
                ->where('company_id', '!=', Auth::user()->company_id)
                ->exists();
            if ($invalidUsers) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Seçilen personellerden biri veya birkaçı sizin şirketinize ait değil.');
            }
        }

        // Çoklu dil desteği için name ve description alanlarını JSON formatına dönüştür
        $nameTranslations = [
            'tr' => $request->input('name_tr', ''),
            'en' => $request->input('name_en', ''),
            'de' => $request->input('name_de', ''),
            'ru' => $request->input('name_ru', ''),
        ];
        $descriptionTranslations = [
            'tr' => $request->input('description_tr', ''),
            'en' => $request->input('description_en', ''),
            'de' => $request->input('description_de', ''),
            'ru' => $request->input('description_ru', ''),
        ];
        
        // Eğer eski format kullanılıyorsa (geriye dönük uyumluluk)
        if ($request->has('name') && !$request->has('name_tr')) {
            $nameTranslations['tr'] = $request->input('name');
            $descriptionTranslations['tr'] = $request->input('description', '');
        }
        
        $category = new Category();
        $category->name = $nameTranslations;
        $category->slug = \Str::slug($nameTranslations['tr'] ?: $nameTranslations['en'] ?: 'category');
        $category->parent_id = $parentId;
        $category->description = $descriptionTranslations;
        $category->sort_order = (int) $request->input('sort_order', 0);
        $category->is_active = (int) $request->input('is_active');
        $category->company_id = Auth::user()->company_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category->image_path = $path;
        }

        $category->save();

        // Görevlileri ata
        if (!empty($userIds)) {
            $category->users()->attach($userIds);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla eklendi.');
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
