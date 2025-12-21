<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Şirketi',
                'email' => 'info@testfirma.com',
                'phone' => '0212 555 12 34',
                'address' => 'İstanbul, Türkiye',
                'tax_number' => '1234567890',
                'tax_office' => 'Kadıköy Vergi Dairesi',
                'logo_path' => 'companies/logos/cTubuTXSz0nzIFNNDfuo4Si09priYGkXF4tlyksj.jpg',
                'logo_type' => 'company',
                'is_active' => 1,
                'license_expires_at' => '2026-01-20',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 17:42:59',
            ),
        ));
        
        
    }
}