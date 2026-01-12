<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
        $type = $request->input('type');
        $category_id = $request->input('category_id');

        $products = Product::query()
            ->where('company_id', Auth::user()->company_id)
            ->with(['category'])
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('slug', 'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%");
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($category_id, function ($query, $category_id) {
                $query->where('category_id', $category_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::where('company_id', Auth::user()->company_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.product.products', compact('products', 'categories', 'q', 'status', 'type', 'category_id'));
    }

    public function create()
    {
        $categories = Category::where('company_id', Auth::user()->company_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.product.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_tr' => 'required_without:name|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_de' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'name' => 'required_without:name_tr|string|max:255', // Geriye dönük uyumluluk
            'category_id' => 'required|exists:categories,id',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_de' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description' => 'nullable|string', // Geriye dönük uyumluluk
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sale,service',
            'is_active' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Kategori kontrolü - aynı şirkete ait olmalı
        $category = Category::where('company_id', Auth::user()->company_id)
            ->findOrFail($request->input('category_id'));

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
        
        $product = new Product();
        $product->name = $nameTranslations;
        $product->slug = Str::slug($nameTranslations['tr'] ?: $nameTranslations['en'] ?: 'product');
        $product->category_id = $request->input('category_id');
        $product->description = $descriptionTranslations;
        $product->price = $request->input('price');
        $product->type = $request->input('type');
        $product->is_active = (int) $request->input('is_active');
        $product->company_id = Auth::user()->company_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Ürün başarıyla eklendi.');
    }

    public function edit($id)
    {
        $product = Product::where('company_id', Auth::user()->company_id)->findOrFail($id);
        
        $categories = Category::where('company_id', Auth::user()->company_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.product.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_tr' => 'required_without:name|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_de' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'name' => 'required_without:name_tr|string|max:255', // Geriye dönük uyumluluk
            'category_id' => 'required|exists:categories,id',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_de' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'description' => 'nullable|string', // Geriye dönük uyumluluk
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sale,service',
            'is_active' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::where('company_id', Auth::user()->company_id)->findOrFail($id);

        // Kategori kontrolü - aynı şirkete ait olmalı
        $category = Category::where('company_id', Auth::user()->company_id)
            ->findOrFail($request->input('category_id'));

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
        
        $product->name = $nameTranslations;
        $product->slug = Str::slug($nameTranslations['tr'] ?: $nameTranslations['en'] ?: 'product');
        $product->category_id = $request->input('category_id');
        $product->description = $descriptionTranslations;
        $product->price = $request->input('price');
        $product->type = $request->input('type');
        $product->is_active = (int) $request->input('is_active');

        if ($request->hasFile('image')) {
            // Eski görseli sil
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    public function destroy(Product $product)
    {
        if ($product->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu ürüne erişim yetkiniz yok.');
        }

        // Görseli sil
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->back()
            ->with('success', 'Ürün başarıyla silindi.');
    }
}
