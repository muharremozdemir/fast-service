<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test şirketi oluştur
        $company = Company::create([
            'name' => 'Test Şirketi',
            'email' => 'info@testfirma.com',
            'phone' => '0212 555 12 34',
            'address' => 'İstanbul, Türkiye',
            'tax_number' => '1234567890',
            'tax_office' => 'Kadıköy Vergi Dairesi',
            'is_active' => true,
            'license_expires_at' => null,
            'logo_path' => null,
            'logo_type' => 'fast_service',
        ]);

        // Yönetici kullanıcı oluştur
        User::create([
            'name' => 'Yönetici',
            'email' => 'iletisim@muharremozdemir.com',
            'phone' => '5423024234',
            'company_id' => $company->id,
            'password' => Hash::make('password'), // Geçici şifre, OTP sistemi ile değiştirilecek
        ]);
    }
}
