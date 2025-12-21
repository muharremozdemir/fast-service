<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
            'license_extension_type' => 'nullable|in:days,months,years,date',
            'license_extension_value' => 'nullable|integer|min:1',
            'license_extension_date' => 'nullable|date',
            'logo_type' => 'required|in:fast_service,company',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'remove_logo' => 'nullable|boolean',
        ]);

        $company = Company::findOrFail($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->tax_number = $request->input('tax_number');
        $company->tax_office = $request->input('tax_office');
        $company->is_active = $request->input('is_active', 0);
        $company->logo_type = $request->input('logo_type', 'fast_service');
        
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

        // Lisans uzatma işlemi
        $extensionType = $request->input('license_extension_type');
        if ($extensionType) {
            $currentDate = $company->license_expires_at ? $company->license_expires_at : now();
            
            if ($extensionType === 'date') {
                $newDate = $request->input('license_extension_date');
                if ($newDate) {
                    $company->license_expires_at = \Carbon\Carbon::parse($newDate);
                }
            } else {
                $value = $request->input('license_extension_value');
                if ($value) {
                    $value = (int) $value; // String'i integer'a cast et
                    if ($extensionType === 'days') {
                        $company->license_expires_at = $currentDate->copy()->addDays($value);
                    } elseif ($extensionType === 'months') {
                        $company->license_expires_at = $currentDate->copy()->addMonths($value);
                    } elseif ($extensionType === 'years') {
                        $company->license_expires_at = $currentDate->copy()->addYears($value);
                    }
                }
            }
        }

        $company->save();

        $message = 'Şirket başarıyla güncellendi.';
        if ($extensionType) {
            $message .= ' Lisans süresi güncellendi.';
        }

        return redirect()
            ->route('admin.companies.edit', $company->id)
            ->with('success', $message);
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

        // hotel-admin rolünü oluştur (web guard için)
        setPermissionsTeamId($company->id);
        $hotelAdminRoleWeb = Role::firstOrCreate(
            [
                'name' => 'hotel-admin',
                'guard_name' => 'web',
                'company_id' => $company->id,
            ]
        );

        // hotel-admin rolünü oluştur (api guard için)
        $hotelAdminRoleApi = Role::firstOrCreate(
            [
                'name' => 'hotel-admin',
                'guard_name' => 'api',
                'company_id' => $company->id,
            ]
        );

        // Yönetici kullanıcısını rollere ata
        setPermissionsTeamId($company->id);
        if (!$admin->hasRole($hotelAdminRoleWeb)) {
            $admin->assignRole($hotelAdminRoleWeb);
        }
        
        // API guard için rol atamasını manuel olarak yap (User modeli web guard kullandığı için)
        $apiRoleExists = DB::table('model_has_roles')
            ->where('model_type', get_class($admin))
            ->where('model_id', $admin->id)
            ->where('role_id', $hotelAdminRoleApi->id)
            ->where('company_id', $company->id)
            ->exists();
            
        if (!$apiRoleExists) {
            DB::table('model_has_roles')->insert([
                'role_id' => $hotelAdminRoleApi->id,
                'model_type' => get_class($admin),
                'model_id' => $admin->id,
                'company_id' => $company->id,
            ]);
        }

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
