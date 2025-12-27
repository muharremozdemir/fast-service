<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => NULL,
                'name' => 'Oda Servisi',
                'slug' => 'oda-servisi',
                'image_path' => NULL,
                'sort_order' => 1,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => NULL,
                'name' => 'Otel Hizmetleri',
                'slug' => 'otel-hizmetleri',
                'image_path' => NULL,
                'sort_order' => 2,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => NULL,
                'name' => 'Arıza Bildirimi',
                'slug' => 'ariza-bildirimi',
                'image_path' => NULL,
                'sort_order' => 3,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => NULL,
                'name' => 'Resepsiyon İletişim',
                'slug' => 'resepsiyon-iletisim',
                'image_path' => NULL,
                'sort_order' => 4,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 1,
                'name' => 'Yemekler',
                'slug' => 'yemekler',
                'image_path' => NULL,
                'sort_order' => 1,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 1,
                'name' => 'İçecekler',
                'slug' => 'icecekler',
                'image_path' => NULL,
                'sort_order' => 2,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            6 => 
            array (
                'id' => 7,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 2,
                'name' => 'Otopark',
                'slug' => 'otopark',
                'image_path' => NULL,
                'sort_order' => 1,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            7 => 
            array (
                'id' => 8,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 2,
                'name' => 'SPA & Wellness',
                'slug' => 'spa-wellness',
                'image_path' => NULL,
                'sort_order' => 2,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            8 => 
            array (
                'id' => 9,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 3,
                'name' => 'Elektrik Arızası',
                'slug' => 'elektrik-arizasi',
                'image_path' => NULL,
                'sort_order' => 1,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            9 => 
            array (
                'id' => 10,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 3,
                'name' => 'TV / Klima',
                'slug' => 'tv-klima',
                'image_path' => NULL,
                'sort_order' => 2,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            10 => 
            array (
                'id' => 11,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 4,
                'name' => 'Telefon',
                'slug' => 'telefon',
                'image_path' => NULL,
                'sort_order' => 1,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            11 => 
            array (
                'id' => 12,
                'company_id' => 1,
                'user_id' => NULL,
                'parent_id' => 4,
                'name' => 'Danışma',
                'slug' => 'danisma',
                'image_path' => NULL,
                'sort_order' => 2,
                'is_active' => 1,
                'description' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
        ));
        
        
    }
}