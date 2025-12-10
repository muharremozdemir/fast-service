<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();

        if ($products->isEmpty()) {
            $this->command->warn('Aktif ürün bulunamadı. Önce ürünler oluşturulmalı.');
            return;
        }

        // Farklı tarihler için referans noktaları
        $dateRanges = [
            Carbon::now()->subDays(rand(0, 1)), // Bugün veya dün
            Carbon::now()->subDays(rand(2, 7)), // Geçen hafta
            Carbon::now()->subDays(rand(8, 30)), // Geçen ay
            Carbon::now()->subDays(rand(31, 180)), // 6 ay önce
            Carbon::now()->subDays(rand(181, 365)), // 1 yıl önce
        ];

        foreach ($rooms as $room) {
            // Her oda için 2-3 sipariş oluştur
            $orderCount = rand(2, 3);
            
            for ($i = 0; $i < $orderCount; $i++) {
                // Rastgele bir tarih seç
                $orderDate = $dateRanges[array_rand($dateRanges)];
                $closedDate = $orderDate->copy()->addHours(rand(1, 6)); // Sipariş 1-6 saat sonra tamamlandı

                // Sipariş için 1-3 ürün seç
                $selectedProducts = $products->random(rand(1, min(3, $products->count())));
                
                // Toplam tutarı hesapla
                $total = 0;
                $orderItems = [];
                
                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 3);
                    $itemTotal = $product->price * $quantity;
                    $total += $itemTotal;
                    
                    $orderItems[] = [
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ];
                }

                // Sipariş oluştur
                $order = Order::create([
                    'room_id' => $room->id,
                    'room_number' => $room->room_number,
                    'order_number' => Order::generateOrderNumber(),
                    'status' => 'completed',
                    'total' => $total,
                    'notes' => null,
                    'closed_at' => $closedDate,
                    'created_at' => $orderDate,
                    'updated_at' => $closedDate,
                ]);

                // Sipariş kalemlerini oluştur
                foreach ($orderItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'created_at' => $orderDate,
                        'updated_at' => $orderDate,
                    ]);
                }
            }
        }

        $this->command->info('Siparişler başarıyla oluşturuldu.');
    }
}
