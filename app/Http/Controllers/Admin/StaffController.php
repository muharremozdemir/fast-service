<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    /**
     * Personel listesi
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $sort = $request->input('sort', 'name');
        $perPage = $request->input('per_page', 15);

        $query = User::query()
            ->where('company_id', Auth::user()->company_id)
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%")
                          ->orWhere('phone', 'like', "%{$q}%");
                });
            });

        // Sıralama
        if ($sort === 'name') {
            $query->orderBy('name');
        } elseif ($sort === 'created_desc') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'created_asc') {
            $query->orderBy('created_at', 'asc');
        }

        $users = $query->paginate($perPage)->withQueryString();

        // Her kullanıcının rollerini yükle
        foreach ($users as $user) {
            setPermissionsTeamId($user->company_id);
            $user->load('roles');
        }

        // İstatistikler
        $totalStaff = User::where('company_id', Auth::user()->company_id)->count();
        $staffWithRoles = User::where('company_id', Auth::user()->company_id)
            ->whereHas('roles')
            ->count();
        $staffWithoutRoles = $totalStaff - $staffWithRoles;

        return view('admin.staff.index', compact('users', 'q', 'sort', 'perPage', 'totalStaff', 'staffWithRoles', 'staffWithoutRoles'));
    }

    /**
     * Yeni personel ekleme formu
     */
    public function create()
    {
        // Sadece giriş yapan kullanıcının company_id'sine göre roller
        $roles = Role::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        return view('admin.staff.create', compact('roles'));
    }

    /**
     * Yeni personel kaydet
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:50',
            'roles' => 'nullable|array',
            'roles.*' => [
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    $role = Role::find($value);
                    if ($role && $role->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen rol sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Ad Soyad gereklidir.',
            'email.required' => 'E-posta gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'phone.required' => 'Telefon numarası gereklidir.',
        ]);

        // Rastgele güvenli şifre oluştur (12 karakter, büyük/küçük harf, rakam ve özel karakter)
        $randomPassword = \Illuminate\Support\Str::random(12);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($randomPassword),
            'company_id' => Auth::user()->company_id,
        ]);

        // Rolleri ata
        if ($request->has('roles')) {
            setPermissionsTeamId(Auth::user()->company_id);
            
            $roles = Role::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('roles'))
                ->get();

            foreach ($roles as $role) {
                if (!$user->hasRole($role)) {
                    $user->assignRole($role);
                }
            }
        }

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Personel başarıyla eklendi.');
    }

    /**
     * Personel düzenleme formu
     */
    public function edit($id)
    {
        $user = User::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        // Sadece giriş yapan kullanıcının company_id'sine göre roller
        $roles = Role::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        // Kullanıcının mevcut rollerini yükle
        setPermissionsTeamId($user->company_id);
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.staff.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Personel güncelle
     */
    public function update(Request $request, $id)
    {
        $user = User::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:50',
            'roles' => 'nullable|array',
            'roles.*' => [
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    $role = Role::find($value);
                    if ($role && $role->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen rol sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Ad Soyad gereklidir.',
            'email.required' => 'E-posta gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'phone.required' => 'Telefon numarası gereklidir.',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        // Rolleri güncelle
        setPermissionsTeamId(Auth::user()->company_id);
        
        // Mevcut rolleri kaldır
        $user->roles()->detach();

        // Yeni rolleri ata
        if ($request->has('roles')) {
            $roles = Role::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('roles'))
                ->get();

            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Personel başarıyla güncellendi.');
    }
}

