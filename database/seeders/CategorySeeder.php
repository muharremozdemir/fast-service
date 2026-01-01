<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('tr_TR');

        // Company ID'yi sabitle
        $companyId = 5;

        // Mevcut ürünleri sil (sadece company_id=5 olanlar, kategorilerden önce silinmeli çünkü foreign key var)
        Product::where('company_id', $companyId)->delete();
        
        // Mevcut kategorileri sil (sadece company_id=5 olanlar)
        Category::where('company_id', $companyId)->delete();

        // 5 Ana kategori
        $mainCategories = [
            ['name' => 'Oda Servisi', 'sort_order' => 1],
            ['name' => 'Otel Hizmetleri', 'sort_order' => 2],
            ['name' => 'Arıza Bildirimi', 'sort_order' => 3],
            ['name' => 'Resepsiyon İletişim', 'sort_order' => 4],
            ['name' => 'Eğlence & Aktivite', 'sort_order' => 5],
        ];

        $parentMap = [];

        // Ana kategorileri oluştur
        foreach ($mainCategories as $mainCat) {
            $slug = Str::slug($mainCat['name']);
            $parentMap[$slug] = Category::create([
                'name' => $mainCat['name'],
                'slug' => $slug,
                'sort_order' => $mainCat['sort_order'],
                'is_active' => true,
                'parent_id' => null,
                'company_id' => $companyId,
                'description' => $faker->sentence(10),
            ]);
        }

        // Her ana kategori için 5 alt kategori ve her alt kategori için 10 ürün
        $subCategoryNames = [
            'Oda Servisi' => [
                'Yemekler', 'İçecekler', 'Atıştırmalıklar', 'Kahvaltı', 'Özel Menüler'
            ],
            'Otel Hizmetleri' => [
                'Otopark', 'SPA & Wellness', 'Çamaşırhane', 'Temizlik', 'Bagaj Hizmetleri'
            ],
            'Arıza Bildirimi' => [
                'Elektrik Arızası', 'TV / Klima', 'Su Tesisatı', 'Internet Sorunu', 'Diğer Arızalar'
            ],
            'Resepsiyon İletişim' => [
                'Telefon', 'Danışma', 'Rezervasyon', 'Çeviri Hizmeti', 'Turist Bilgileri'
            ],
            'Eğlence & Aktivite' => [
                'Fitness', 'Havuz', 'Oyun Salonu', 'Konser & Etkinlik', 'Geziler'
            ],
        ];

        $productTemplates = [
            'Yemekler' => [
                'Tavuk Izgara', 'Etli Noodle', 'Balık Tava', 'Pizza Margherita', 'Hamburger Menü',
                'Döner Tabağı', 'Köfte Tabağı', 'Lahmacun', 'Pide', 'Mantı'
            ],
            'İçecekler' => [
                'Limonata', 'Soğuk Çay', 'Taze Sıkılmış Portakal Suyu', 'Kahve', 'Çay',
                'Kola', 'Gazoz', 'Ayran', 'Meyve Suyu', 'Enerji İçeceği'
            ],
            'Atıştırmalıklar' => [
                'Cips', 'Çikolata', 'Kuruyemiş Karışımı', 'Bisküvi', 'Kek',
                'Pasta Dilimi', 'Dondurma', 'Meyve Tabağı', 'Sandviç', 'Tost'
            ],
            'Kahvaltı' => [
                'Serpme Kahvaltı', 'Menemen', 'Omlet', 'Sucuklu Yumurta', 'Peynir Tabağı',
                'Zeytin Tabağı', 'Bal & Kaymak', 'Reçel Çeşitleri', 'Tereyağı', 'Ekmek Çeşitleri'
            ],
            'Özel Menüler' => [
                'Vejetaryen Menü', 'Vegan Menü', 'Glutensiz Menü', 'Diyabetik Menü', 'Çocuk Menüsü',
                'Romantik Akşam Yemeği', 'İş Yemeği Menüsü', 'Özel Gün Menüsü', 'Hızlı Menü', 'Lüks Menü'
            ],
            'Otopark' => [
                'Günlük Otopark', 'Vale Hizmeti', 'Haftalık Otopark', 'Aylık Otopark', 'Gece Otopark',
                'VIP Otopark', 'Kapalı Otopark', 'Açık Otopark', 'Elektrikli Araç Şarj', 'Otopark Yıkama'
            ],
            'SPA & Wellness' => [
                'Masaj Seansı', 'Buhar Odası', 'Sauna', 'Jakuzi', 'Hamam',
                'Cilt Bakımı', 'Vücut Bakımı', 'Manikür', 'Pedikür', 'Aromaterapi'
            ],
            'Çamaşırhane' => [
                'Gömlek Yıkama', 'Takım Elbise Yıkama', 'Kuru Temizleme', 'Ütü Hizmeti', 'Acil Yıkama',
                'Toplu Yıkama', 'Özel Kumaş Yıkama', 'Ayakkabı Temizleme', 'Çanta Temizleme', 'Perde Yıkama'
            ],
            'Temizlik' => [
                'Oda Temizliği', 'Derinlemesine Temizlik', 'Cam Temizliği', 'Halı Yıkama', 'Perde Temizliği',
                'Banyo Temizliği', 'Mutfak Temizliği', 'Balkon Temizliği', 'Düzenleme Hizmeti', 'Özel Temizlik'
            ],
            'Bagaj Hizmetleri' => [
                'Bagaj Taşıma', 'Bagaj Depolama', 'Acil Bagaj', 'Havalimanı Transfer', 'Bagaj Paketleme',
                'Kırılgan Eşya Taşıma', 'Ağır Bagaj', 'Bagaj Etiketleme', 'Güvenli Depolama', 'Bagaj Teslim'
            ],
            'Elektrik Arızası' => [
                'Lambanın Yanmaması', 'Priz Sorunu', 'Sigorta Atması', 'Elektrik Kesintisi', 'Ampul Değişimi',
                'Anahtar Arızası', 'Elektrikli Alet Sorunu', 'Şarj Sorunu', 'Elektrik Kaçağı', 'Elektrik Panosu'
            ],
            'TV / Klima' => [
                'Kumanda Çalışmıyor', 'Klima Soğutmuyor', 'TV Açılmıyor', 'Ses Sorunu', 'Görüntü Sorunu',
                'Kanal Bulunamıyor', 'Klima Isıtmıyor', 'Klima Gürültülü', 'TV Donuyor', 'Uydu Sorunu'
            ],
            'Su Tesisatı' => [
                'Musluk Arızası', 'Sıcak Su Gelmiyor', 'Tıkanıklık', 'Su Kaçağı', 'Duş Başlığı Sorunu',
                'Klozet Arızası', 'Lavabo Tıkanıklığı', 'Su Basıncı Düşük', 'Su Filtresi', 'Su Isıtıcı Arızası'
            ],
            'Internet Sorunu' => [
                'WiFi Bağlanmıyor', 'İnternet Yavaş', 'Sinyal Zayıf', 'Şifre Sorunu', 'Bağlantı Kesiliyor',
                'Modem Arızası', 'Kablo Sorunu', 'Port Sorunu', 'DNS Hatası', 'Ağ Ayarları'
            ],
            'Diğer Arızalar' => [
                'Kapı Kilit Sorunu', 'Pencere Açılmıyor', 'Perde Mekanizması', 'Mobilya Arızası', 'Ayna Kırıldı',
                'Halı Yırtıldı', 'Duvar Hasarı', 'Tavan Lezyonu', 'Balkon Kapısı', 'Güvenlik Sistemi'
            ],
            'Telefon' => [
                'Oda ile Görüşme', 'Dış Hat', 'Uluslararası Arama', 'Faks Gönderimi', 'Telefon Arızası',
                'Sesli Mesaj', 'Konferans Görüşmesi', 'Acil Arama', 'Telefon Rehberi', 'Çağrı Yönlendirme'
            ],
            'Danışma' => [
                'Yakın Restoranlar', 'Etkinlik Bilgisi', 'Turistik Yerler', 'Ulaşım Bilgisi', 'Hava Durumu',
                'Döviz Kuru', 'Alışveriş Merkezleri', 'Eczane Bilgisi', 'Hastane Bilgisi', 'Güvenlik Bilgisi'
            ],
            'Rezervasyon' => [
                'Restoran Rezervasyonu', 'Taksi Çağırma', 'Uçak Rezervasyonu', 'Tiyatro Bileti', 'Spa Rezervasyonu',
                'Tur Rezervasyonu', 'Araç Kiralama', 'Transfer Hizmeti', 'Etkinlik Bileti', 'Özel Rezervasyon'
            ],
            'Çeviri Hizmeti' => [
                'İngilizce Çeviri', 'Almanca Çeviri', 'Fransızca Çeviri', 'Rusça Çeviri', 'Arapça Çeviri',
                'Yazılı Çeviri', 'Sözlü Çeviri', 'Telefon Çevirisi', 'Belge Çevirisi', 'Acil Çeviri'
            ],
            'Turist Bilgileri' => [
                'Şehir Haritası', 'Toplu Taşıma Rehberi', 'Müze Bilgileri', 'Tarihi Yerler', 'Kültürel Etkinlikler',
                'Yerel Yemekler', 'Alışveriş İpuçları', 'Güvenlik Önerileri', 'Para Birimi', 'Vize Bilgileri'
            ],
            'Fitness' => [
                'Fitness Salonu Giriş', 'Kişisel Antrenör', 'Grup Dersi', 'Yoga Dersi', 'Pilates Dersi',
                'Kardiyovasküler Ekipman', 'Ağırlık Antrenmanı', 'Esneklik Dersi', 'Fitness Programı', 'Spor Malzemesi'
            ],
            'Havuz' => [
                'Havuz Girişi', 'Havuz Barı', 'Havuz Şezlongu', 'Havuz Havlusu', 'Yüzme Dersi',
                'Aqua Aerobik', 'Havuz Partisi', 'Özel Havuz Kullanımı', 'Havuz Güvenliği', 'Havuz Ekipmanı'
            ],
            'Oyun Salonu' => [
                'Bilardo', 'PlayStation', 'Xbox', 'Masa Tenisi', 'Dart',
                'Satranç', 'Tavla', 'Kart Oyunları', 'Oyun Turnuvası', 'Eğlence Paketi'
            ],
            'Konser & Etkinlik' => [
                'Konser Bileti', 'Tiyatro Bileti', 'Stand-up Bileti', 'Müzik Gecesi', 'Dans Gösterisi',
                'Özel Etkinlik', 'Doğum Günü Organizasyonu', 'Yıldönümü Paketi', 'Gala Gecesi', 'Tema Gecesi'
            ],
            'Geziler' => [
                'Şehir Turu', 'Müze Turu', 'Doğa Yürüyüşü', 'Tekne Turu', 'Helikopter Turu',
                'Gastronomi Turu', 'Tarihi Tur', 'Alışveriş Turu', 'Gece Turu', 'Özel Tur'
            ],
        ];

        // Her ana kategori için işlem yap
        foreach ($mainCategories as $mainCat) {
            $mainSlug = Str::slug($mainCat['name']);
            $subCategories = $subCategoryNames[$mainCat['name']];

            // Her ana kategori için 5 alt kategori oluştur
            foreach ($subCategories as $subIndex => $subCatName) {
                $subSlug = Str::slug($subCatName);
                $childCategory = Category::create([
                    'name' => $subCatName,
                    'slug' => $subSlug, // company_id ile birlikte unique
                    'sort_order' => $subIndex + 1,
                    'is_active' => true,
                    'parent_id' => $parentMap[$mainSlug]->id,
                    'company_id' => $companyId,
                    'description' => $faker->sentence(8),
                ]);

                // Her alt kategori için 10 ürün oluştur
                $products = $productTemplates[$subCatName] ?? [];
                
                for ($i = 0; $i < 10; $i++) {
                    $productName = $products[$i] ?? $subCatName . ' Ürün ' . ($i + 1);
                    $basePrice = $faker->numberBetween(10, 500);
                    
                    // Arıza bildirimi kategorilerinde fiyat 0
                    if (in_array($mainCat['name'], ['Arıza Bildirimi', 'Resepsiyon İletişim'])) {
                        $price = 0;
                        $type = 'service';
                    } else {
                        $price = $basePrice;
                        $type = 'sale';
                    }

                    // Slug oluştur (alt kategori slug'ı ile birlikte benzersiz, company_id ile birlikte unique)
                    $productSlug = Str::slug($productName);
                    // Aynı ürün adı farklı kategorilerde olabilir, bu yüzden kategori slug'ını ekle
                    $productSlug = $subSlug . '-' . $productSlug;

                    Product::create([
                        'name' => $productName,
                        'slug' => $productSlug,
                        'price' => $price,
                        'description' => $faker->sentence(12),
                        'is_active' => true,
                        'category_id' => $childCategory->id,
                        'company_id' => $companyId,
                        'type' => $type,
                    ]);
                }
            }
        }
    }
}
