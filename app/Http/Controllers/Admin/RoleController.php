<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Rolleri listele
     */
    public function index(Request $request)
    {
        $q = $request->input('q');

        $roles = Role::query()
            ->where('company_id', Auth::user()->company_id)
            ->when($q, function ($query, $q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.role.roles', compact('roles', 'q'));
    }

    /**
     * Yeni rol ekleme formu
     */
    public function create()
    {
        $permissions = Permission::where('company_id', Auth::user()->company_id)
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return $permission->group ?? 'Diğer';
            });

        return view('admin.role.add-role', compact('permissions'));
    }

    /**
     * Yeni rol kaydet
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,NULL,id,company_id,' . Auth::user()->company_id,
            'permissions' => 'nullable|array',
            'permissions.*' => [
                'exists:permissions,id',
                function ($attribute, $value, $fail) {
                    $permission = Permission::find($value);
                    if ($permission && $permission->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen yetki sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Rol adı gereklidir.',
            'name.unique' => 'Bu rol adı zaten kullanılıyor.',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'company_id' => Auth::user()->company_id,
        ]);

        if ($request->has('permissions')) {
            // Company_id context'ini ayarla
            setPermissionsTeamId(Auth::user()->company_id);

            $permissions = Permission::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('permissions'))
                ->get();

            // Mevcut permission'ları sil
            DB::table('role_has_permissions')
                ->where('role_id', $role->id)
                ->where('company_id', Auth::user()->company_id)
                ->delete();

            // Yeni permission'ları ekle
            $insertData = [];
            foreach ($permissions as $permission) {
                $insertData[] = [
                    'permission_id' => $permission->id,
                    'role_id' => $role->id,
                    'company_id' => Auth::user()->company_id,
                ];
            }

            if (!empty($insertData)) {
                DB::table('role_has_permissions')->insert($insertData);
            }
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol başarıyla eklendi.');
    }

    /**
     * Rol düzenleme formu
     */
    public function edit($id)
    {
        $role = Role::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $permissions = Permission::where('company_id', Auth::user()->company_id)
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return $permission->group ?? 'Diğer';
            });

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.role.edit-role', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Rol güncelle
     */
    public function update(Request $request, $id)
    {
        $role = Role::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id . ',id,company_id,' . Auth::user()->company_id,
            'permissions' => 'nullable|array',
            'permissions.*' => [
                'exists:permissions,id',
                function ($attribute, $value, $fail) {
                    $permission = Permission::find($value);
                    if ($permission && $permission->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen yetki sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Rol adı gereklidir.',
            'name.unique' => 'Bu rol adı zaten kullanılıyor.',
        ]);

        $role->name = $request->input('name');
        $role->save();

        // Company_id context'ini ayarla
        setPermissionsTeamId(Auth::user()->company_id);

        // Mevcut permission'ları sil
        DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->where('company_id', Auth::user()->company_id)
            ->delete();

        if ($request->has('permissions')) {
            $permissions = Permission::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('permissions'))
                ->get();

            // Yeni permission'ları ekle
            $insertData = [];
            foreach ($permissions as $permission) {
                $insertData[] = [
                    'permission_id' => $permission->id,
                    'role_id' => $role->id,
                    'company_id' => Auth::user()->company_id,
                ];
            }

            if (!empty($insertData)) {
                DB::table('role_has_permissions')->insert($insertData);
            }
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol başarıyla güncellendi.');
    }

    /**
     * Rol sil
     */
    public function destroy($id)
    {
        $role = Role::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        // Eğer rol kullanıcılara atanmışsa silme
        if ($role->users()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Bu rol kullanıcılara atanmış olduğu için silinemez.');
        }

        $role->delete();

        return redirect()
            ->back()
            ->with('success', 'Rol başarıyla silindi.');
    }
}

