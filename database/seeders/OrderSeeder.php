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
        // Tüm şirketler için sipariş oluştur
        $companies = \App\Models\Company::all();
        
        if ($companies->isEmpty()) {
            $this->command->warn('Şirket bulunamadı. Önce şirketler oluşturulmalı.');
            return;
        }

        $totalOrdersCreated = 0;

        foreach ($companies as $company) {
            $rooms = Room::where('company_id', $company->id)
                ->where('is_active', true)
                ->get();
            
            $products = Product::where('company_id', $company->id)
                ->where('is_active', true)
                ->get();

            if ($products->isEmpty() || $rooms->isEmpty()) {
                $this->command->warn("Şirket '{$company->name}' için aktif ürün veya oda bulunamadı. Atlanıyor.");
                continue;
            }

            // Son 3 ay içinde rastgele tarihler
            $daysAgo = [0, 1, 2, 3, 4, 5, 6, 7, 14, 21, 30, 45, 60, 90];

            // Her oda için 3-8 sipariş oluştur
            foreach ($rooms as $room) {
                $orderCount = rand(3, 8);
                
                for ($i = 0; $i < $orderCount; $i++) {
                    // Rastgele bir tarih seç
                    $daysBack = $daysAgo[array_rand($daysAgo)];
                    $orderDate = Carbon::now()->subDays($daysBack)
                        ->subHours(rand(0, 23))
                        ->subMinutes(rand(0, 59));
                    
                    $closedDate = $orderDate->copy()->addMinutes(rand(10, 120)); // Sipariş 10-120 dakika sonra tamamlandı

                    // Sipariş için 1-5 ürün seç
                    $selectedProducts = $products->random(rand(1, min(5, $products->count())));
                    
                    // Toplam tutarı hesapla
                    $total = 0;
                    $orderItems = [];
                    
                    foreach ($selectedProducts as $product) {
                        $quantity = rand(1, 5);
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
                        'company_id' => $company->id,
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
                    
                    $totalOrdersCreated++;
                }
            }
        }

        $this->command->info("Toplam {$totalOrdersCreated} adet sipariş başarıyla oluşturuldu!");
    }
}
