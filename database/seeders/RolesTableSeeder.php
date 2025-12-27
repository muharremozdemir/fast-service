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
            1 => 
            array (
                'id' => 2,
                'company_id' => 3,
                'name' => 'Hotel Admin',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 19:18:41',
                'updated_at' => '2025-12-24 20:11:45',
            ),
            2 => 
            array (
                'id' => 6,
                'company_id' => 3,
                'name' => 'Resepsiyon',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 20:06:21',
                'updated_at' => '2025-12-24 20:06:21',
            ),
        ));
        
        
    }
}