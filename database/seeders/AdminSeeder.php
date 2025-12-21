<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin için özel company_id = 0 kullan (sistem admin)
        $adminCompanyId = 0;
        setPermissionsTeamId($adminCompanyId);

        // Admin kullanıcısını oluştur veya güncelle
        $admin = User::firstOrCreate(
            ['email' => 'iletisim@hotelfastservice.com'],
            [
                'name' => 'Admin',
                'phone' => '5423024234',
                'company_id' => null, // User tablosunda null olabilir
                'password' => Hash::make('password'), // İlk şifre, sonra değiştirilebilir
            ]
        );

        // Admin rolünü oluştur (company_id = 0)
        $adminRole = Role::firstOrCreate(
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'company_id' => $adminCompanyId,
            ]
        );

        // Firma ekleme iznini oluştur
        $createCompanyPermission = Permission::firstOrCreate(
            [
                'name' => 'create company',
                'guard_name' => 'web',
                'company_id' => $adminCompanyId,
            ]
        );

        // Admin rolüne firma ekleme iznini ata (manuel olarak company_id ile)
        $roleHasPermissionExists = DB::table('role_has_permissions')
            ->where('role_id', $adminRole->id)
            ->where('permission_id', $createCompanyPermission->id)
            ->where('company_id', $adminCompanyId)
            ->exists();

        if (!$roleHasPermissionExists) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $adminRole->id,
                'permission_id' => $createCompanyPermission->id,
                'company_id' => $adminCompanyId,
            ]);
        }

        // Kullanıcıya admin rolünü ata (company_id = 0 ile)
        if (!$admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
        }
    }
}

