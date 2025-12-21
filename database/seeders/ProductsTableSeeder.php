<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => $companyId,
                'category_id' => 5,
                'name' => 'Tavuk Izgara',
                'slug' => 'tavuk-izgara',
                'description' => 'Lezzetli tavuk ızgara',
                'price' => '150.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => $companyId,
                'category_id' => 5,
                'name' => 'Etli Noodle',
                'slug' => 'etli-noodle',
                'description' => 'Uzakdoğu usulü noodle',
                'price' => '200.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => $companyId,
                'category_id' => 6,
                'name' => 'Limonata',
                'slug' => 'limonata',
                'description' => 'Taze limonlu içecek',
                'price' => '30.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => $companyId,
                'category_id' => 6,
                'name' => 'Soğuk Çay',
                'slug' => 'soguk-cay',
                'description' => 'Şeftalili buz gibi çay',
                'price' => '25.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => $companyId,
                'category_id' => 7,
                'name' => 'Günlük Otopark',
                'slug' => 'gunluk-otopark',
                'description' => '1 günlük otopark',
                'price' => '50.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => $companyId,
                'category_id' => 7,
                'name' => 'Vale Hizmeti',
                'slug' => 'vale-hizmeti',
                'description' => 'Vale ile otopark hizmeti',
                'price' => '100.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            6 => 
            array (
                'id' => 7,
                'company_id' => $companyId,
                'category_id' => 8,
                'name' => 'Masaj Seansı',
                'slug' => 'masaj-seansi',
                'description' => 'Rahatlatıcı masaj',
                'price' => '250.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            7 => 
            array (
                'id' => 8,
                'company_id' => $companyId,
                'category_id' => 8,
                'name' => 'Buhar Odası',
                'slug' => 'buhar-odasi',
                'description' => '15 dk buhar odası kullanımı',
                'price' => '150.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            8 => 
            array (
                'id' => 9,
                'company_id' => $companyId,
                'category_id' => 9,
                'name' => 'Lambanın Yanmaması',
                'slug' => 'lambanin-yanmamasi',
                'description' => 'Lamba çalışmıyor',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            9 => 
            array (
                'id' => 10,
                'company_id' => $companyId,
                'category_id' => 9,
                'name' => 'Priz Sorunu',
                'slug' => 'priz-sorunu',
                'description' => 'Priz çalışmıyor',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            10 => 
            array (
                'id' => 11,
                'company_id' => $companyId,
                'category_id' => 10,
                'name' => 'Kumanda Çalışmıyor',
                'slug' => 'kumanda-calismiyor',
                'description' => 'TV kumandası arızalı',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            11 => 
            array (
                'id' => 12,
                'company_id' => $companyId,
                'category_id' => 10,
                'name' => 'Klima Soğutmuyor',
                'slug' => 'klima-sogutmuyor',
                'description' => 'Klima arızası',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            12 => 
            array (
                'id' => 13,
                'company_id' => $companyId,
                'category_id' => 11,
                'name' => 'Oda ile Görüşme',
                'slug' => 'oda-ile-gorusme',
                'description' => 'Başka oda ile telefon',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            13 => 
            array (
                'id' => 14,
                'company_id' => $companyId,
                'category_id' => 11,
                'name' => 'Dış Hat',
                'slug' => 'dis-hat',
                'description' => 'Resepsiyondan dış hat görüşmesi',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            14 => 
            array (
                'id' => 15,
                'company_id' => $companyId,
                'category_id' => 12,
                'name' => 'Yakın Restoranlar',
                'slug' => 'yakin-restoranlar',
                'description' => 'Restoran önerileri',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
            15 => 
            array (
                'id' => 16,
                'company_id' => $companyId,
                'category_id' => 12,
                'name' => 'Etkinlik Bilgisi',
                'slug' => 'etkinlik-bilgisi',
                'description' => 'Otel içi etkinlik bilgisi',
                'price' => '0.00',
                'image' => NULL,
                'is_active' => 1,
                'type' => 'sale',
                'created_at' => '2025-12-21 15:52:51',
                'updated_at' => '2025-12-21 15:52:51',
            ),
        ));
        
        
    }
}