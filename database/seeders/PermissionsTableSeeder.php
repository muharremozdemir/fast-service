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
                'label' => NULL,
                'group' => NULL,
                'guard_name' => 'web',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 3,
                'name' => 'user.index',
                'label' => 'Kullanıcı Listeleme',
                'group' => 'Resepsiyon',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 19:18:41',
                'updated_at' => '2025-12-24 19:18:41',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 3,
                'name' => 'user.create',
                'label' => 'Kullanıcı Ekleme',
                'group' => 'Resepsiyon',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 19:18:41',
                'updated_at' => '2025-12-24 19:18:41',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 3,
                'name' => 'user.edit',
                'label' => 'Kullanıcı Düzenleme',
                'group' => 'Resepsiyon',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 19:18:41',
                'updated_at' => '2025-12-24 19:18:41',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => 3,
                'name' => 'user.update',
                'label' => 'Kullanıcı Güncelleme',
                'group' => 'Resepsiyon',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 19:18:41',
                'updated_at' => '2025-12-24 19:18:41',
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => 3,
                'name' => 'user.destroy',
                'label' => 'Kullanıcı Silme',
                'group' => 'Resepsiyon',
                'guard_name' => 'web',
                'created_at' => '2025-12-24 19:18:41',
                'updated_at' => '2025-12-24 19:18:41',
            ),
        ));
        
        
    }
}