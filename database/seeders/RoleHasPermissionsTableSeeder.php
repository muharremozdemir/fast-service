<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
                'company_id' => 0,
            ),
            1 => 
            array (
                'permission_id' => 2,
                'role_id' => 6,
                'company_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
                'company_id' => 3,
            ),
            3 => 
            array (
                'permission_id' => 3,
                'role_id' => 6,
                'company_id' => 3,
            ),
            4 => 
            array (
                'permission_id' => 4,
                'role_id' => 6,
                'company_id' => 3,
            ),
            5 => 
            array (
                'permission_id' => 5,
                'role_id' => 6,
                'company_id' => 3,
            ),
            6 => 
            array (
                'permission_id' => 6,
                'role_id' => 6,
                'company_id' => 3,
            ),
        ));
        
        
    }
}