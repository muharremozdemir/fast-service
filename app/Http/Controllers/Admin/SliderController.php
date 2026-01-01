<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::where('company_id', Auth::user()->company_id)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'required|in:0,1',
        ]);

        $slider = new Slider();
        $slider->company_id = Auth::user()->company_id;
        $slider->title = $request->input('title');
        $slider->sort_order = (int) $request->input('sort_order', 0);
        $slider->is_active = (int) $request->input('is_active', 1);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image_path = $path;
        }

        $slider->save();

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla eklendi.');
    }

    public function edit($id)
    {
        $slider = Slider::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'required|in:0,1',
        ]);

        $slider = Slider::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $slider->title = $request->input('title');
        $slider->sort_order = (int) $request->input('sort_order', 0);
        $slider->is_active = (int) $request->input('is_active', 1);

        if ($request->hasFile('image')) {
            // Eski görseli sil
            if ($slider->image_path) {
                Storage::disk('public')->delete($slider->image_path);
            }
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image_path = $path;
        }

        $slider->save();

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $slider = Slider::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        // Görseli sil
        if ($slider->image_path) {
            Storage::disk('public')->delete($slider->image_path);
        }

        $slider->delete();

        return redirect()
            ->back()
            ->with('success', 'Slider başarıyla silindi.');
    }
}

