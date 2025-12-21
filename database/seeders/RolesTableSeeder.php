<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 0,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
        ));
        
        
    }
}