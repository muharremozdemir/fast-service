<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Ayarlar sayfasını göster
     */
    public function index()
    {
        $company = Company::where('id', Auth::user()->company_id)->firstOrFail();
        return view('admin.settings.index', compact('company'));
    }

    /**
     * Logo ayarlarını güncelle
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'remove_logo' => 'nullable|boolean',
        ]);

        $company = Company::where('id', Auth::user()->company_id)->firstOrFail();
        
        // Logo yükleme işlemi
        if ($request->has('remove_logo') && $request->input('remove_logo')) {
            // Mevcut logoyu sil
            if ($company->logo_path) {
                \Storage::disk('public')->delete($company->logo_path);
            }
            $company->logo_path = null;
        } elseif ($request->hasFile('logo')) {
            // Eski logoyu sil
            if ($company->logo_path) {
                \Storage::disk('public')->delete($company->logo_path);
            }
            // Yeni logoyu yükle
            $path = $request->file('logo')->store('companies/logos', 'public');
            $company->logo_path = $path;
        }

        $company->save();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Logo başarıyla güncellendi.');
    }
}
