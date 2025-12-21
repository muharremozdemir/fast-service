<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FloorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Test firmasını bul
        $testCompany = \DB::table('companies')->where('name', 'Test Şirketi')->first();
        $companyId = $testCompany ? $testCompany->id : 1;

        \DB::table('floors')->delete();
        
        \DB::table('floors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => $companyId,
                'block_id' => NULL,
                'user_id' => NULL,
                'name' => '1. Kat',
                'floor_number' => 1,
                'description' => '1. kat açıklaması',
                'is_active' => 1,
                'sort_order' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:54',
                'updated_at' => '2025-12-21 15:52:54',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => $companyId,
                'block_id' => NULL,
                'user_id' => NULL,
                'name' => '2. Kat',
                'floor_number' => 2,
                'description' => '2. kat açıklaması',
                'is_active' => 1,
                'sort_order' => 2,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:54',
                'updated_at' => '2025-12-21 15:52:54',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => $companyId,
                'block_id' => NULL,
                'user_id' => NULL,
                'name' => '3. Kat',
                'floor_number' => 3,
                'description' => '3. kat açıklaması',
                'is_active' => 1,
                'sort_order' => 3,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:54',
                'updated_at' => '2025-12-21 15:52:54',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => $companyId,
                'block_id' => NULL,
                'user_id' => NULL,
                'name' => '4. Kat',
                'floor_number' => 4,
                'description' => '4. kat açıklaması',
                'is_active' => 1,
                'sort_order' => 4,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:54',
                'updated_at' => '2025-12-21 15:52:54',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => $companyId,
                'block_id' => NULL,
                'user_id' => NULL,
                'name' => '5. Kat',
                'floor_number' => 5,
                'description' => '5. kat açıklaması',
                'is_active' => 1,
                'sort_order' => 5,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:54',
                'updated_at' => '2025-12-21 15:52:54',
            ),
        ));
        
        
    }
}