<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Test firmasını bul veya oluştur
        $company = Company::firstOrCreate(
            ['name' => 'Test Şirketi'],
            [
                'email' => 'info@testfirma.com',
                'phone' => '0212 555 12 34',
                'address' => 'İstanbul, Türkiye',
                'tax_number' => '1234567890',
                'tax_office' => 'Kadıköy Vergi Dairesi',
                'is_active' => true,
            ]
        );

        $parents = [
            ['name' => 'Oda Servisi',        'sort_order' => 1],
            ['name' => 'Otel Hizmetleri',    'sort_order' => 2],
            ['name' => 'Arıza Bildirimi',    'sort_order' => 3],
            ['name' => 'Resepsiyon İletişim','sort_order' => 4],
        ];

        $parentMap = [];

        foreach ($parents as $p) {
            $slug = Str::slug($p['name']);
            $parentMap[$slug] = Category::create([
                'name'       => $p['name'],
                'slug'       => $slug,
                'sort_order' => $p['sort_order'],
                'is_active'  => true,
                'parent_id'  => null,
                'company_id' => $company->id,
            ]);
        }

        // Alt kategoriler ve ürünleri
        $categoriesWithProducts = [
            'oda-servisi' => [
                ['name' => 'Yemekler', 'products' => [
                    ['name' => 'Tavuk Izgara', 'price' => 150, 'desc' => 'Lezzetli tavuk ızgara'],
                    ['name' => 'Etli Noodle', 'price' => 200, 'desc' => 'Uzakdoğu usulü noodle']
                ]],
                ['name' => 'İçecekler', 'products' => [
                    ['name' => 'Limonata', 'price' => 30, 'desc' => 'Taze limonlu içecek'],
                    ['name' => 'Soğuk Çay', 'price' => 25, 'desc' => 'Şeftalili buz gibi çay']
                ]],
            ],
            'otel-hizmetleri' => [
                ['name' => 'Otopark', 'products' => [
                    ['name' => 'Günlük Otopark', 'price' => 50, 'desc' => '1 günlük otopark'],
                    ['name' => 'Vale Hizmeti', 'price' => 100, 'desc' => 'Vale ile otopark hizmeti']
                ]],
                ['name' => 'SPA & Wellness', 'products' => [
                    ['name' => 'Masaj Seansı', 'price' => 250, 'desc' => 'Rahatlatıcı masaj'],
                    ['name' => 'Buhar Odası', 'price' => 150, 'desc' => '15 dk buhar odası kullanımı']
                ]],
            ],
            'ariza-bildirimi' => [
                ['name' => 'Elektrik Arızası', 'products' => [
                    ['name' => 'Lambanın Yanmaması', 'price' => 0, 'desc' => 'Lamba çalışmıyor'],
                    ['name' => 'Priz Sorunu', 'price' => 0, 'desc' => 'Priz çalışmıyor']
                ]],
                ['name' => 'TV / Klima', 'products' => [
                    ['name' => 'Kumanda Çalışmıyor', 'price' => 0, 'desc' => 'TV kumandası arızalı'],
                    ['name' => 'Klima Soğutmuyor', 'price' => 0, 'desc' => 'Klima arızası']
                ]],
            ],
            'resepsiyon-iletisim' => [
                ['name' => 'Telefon', 'products' => [
                    ['name' => 'Oda ile Görüşme', 'price' => 0, 'desc' => 'Başka oda ile telefon'],
                    ['name' => 'Dış Hat', 'price' => 0, 'desc' => 'Resepsiyondan dış hat görüşmesi']
                ]],
                ['name' => 'Danışma', 'products' => [
                    ['name' => 'Yakın Restoranlar', 'price' => 0, 'desc' => 'Restoran önerileri'],
                    ['name' => 'Etkinlik Bilgisi', 'price' => 0, 'desc' => 'Otel içi etkinlik bilgisi']
                ]],
            ],
        ];

        foreach ($categoriesWithProducts as $parentSlug => $children) {
            foreach ($children as $index => $child) {
                $childCategory = Category::create([
                    'name'       => $child['name'],
                    'slug'       => Str::slug($child['name']),
                    'sort_order' => $index + 1,
                    'is_active'  => true,
                    'parent_id'  => $parentMap[$parentSlug]->id,
                    'company_id' => $company->id,
                ]);

                foreach ($child['products'] as $product) {
                    Product::create([
                        'name'        => $product['name'],
                        'slug'        => Str::slug($product['name']),
                        'price'       => $product['price'],
                        'description' => $product['desc'],
                        'is_active'   => true,
                        'category_id' => $childCategory->id,
                        'company_id'  => $company->id,
                        'type'        => 'sale',
                    ]);
                }
            }
        }
    }
}
