<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 0,
                'name' => 'create company',
                'guard_name' => 'web',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
        ));
        
        
    }
}