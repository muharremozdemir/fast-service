<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
    
        $companies = Company::query()
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%")
                          ->orWhere('phone', 'like', "%{$q}%")
                          ->orWhere('tax_number', 'like', "%{$q}%");
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();
    
        return view('admin.company.companies', compact('companies', 'q', 'status'));
    }

    public function create()
    {
        return view('admin.company.add-company');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit-company', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'tax_number' => 'nullable|string|max:50',
            'tax_office' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $company = Company::findOrFail($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->tax_number = $request->input('tax_number');
        $company->tax_office = $request->input('tax_office');
        $company->is_active = $request->input('is_active', 0);

        $company->save();

        return redirect()
            ->route('admin.companies.edit', $company->id)
            ->with('success', 'Şirket başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'tax_number' => 'nullable|string|max:50',
            'tax_office' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255|unique:users,email',
            'admin_phone' => 'required|string|max:50',
        ]);

        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->tax_number = $request->input('tax_number');
        $company->tax_office = $request->input('tax_office');
        $company->is_active = $request->input('is_active');

        $company->save();

        // Yönetici kullanıcı oluştur
        $admin = new User();
        $admin->name = $request->input('admin_name');
        $admin->email = $request->input('admin_email');
        $admin->phone = $request->input('admin_phone');
        $admin->company_id = $company->id;
        // Password OTP sistemi ile yönetileceği için null bırakılıyor
        $admin->password = null;
        $admin->save();

        return redirect()->route('admin.companies.index')->with('success', 'Şirket ve yönetici kullanıcı başarıyla oluşturuldu. Yönetici girişi SMS ile gönderilecek OTP kodu ile yapılacaktır. SMS ulaşmazsa email ile gönderilecektir.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
    
        return redirect()
            ->back()
            ->with('success', 'Şirket başarıyla silindi.');
    }
}
