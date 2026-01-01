<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Create order from cart
     */
    public function store(Request $request)
    {
        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen önce oda numaranızı girin.'
            ], 400);
        }

        $cart = Cart::where('room_number', $roomNumber)->first();
        
        if (!$cart || $cart->items()->count() === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sepetiniz boş.'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Get cart items with product and category
            $cartItems = $cart->items()->with('product.category')->get();

            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Find room by room_number
            $room = Room::where('room_number', $roomNumber)
                ->where('is_active', true)
                ->first();

            if (!$room) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Oda bulunamadı.'
                ], 400);
            }

            // Create order
            $order = Order::create([
                'room_id' => $room->id,
                'room_number' => $roomNumber,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'total' => $total,
                'notes' => $request->input('notes'),
                'company_id' => $room->company_id,
            ]);

            // Create order items and collect category IDs
            $categoryIds = [];
            foreach ($cartItems as $cartItem) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'status' => 'pending', // Default status: Talep Alındı
                ]);

                // Collect category IDs for notifications
                if ($cartItem->product->category_id) {
                    $categoryIds[] = $cartItem->product->category_id;
                    
                    // Get users assigned to this category and attach them to order item
                    $category = Category::with('users')->find($cartItem->product->category_id);
                    if ($category && $category->users->isNotEmpty()) {
                        $userIds = $category->users->pluck('id')->toArray();
                        $orderItem->notifiedUsers()->attach($userIds);
                    }
                }
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            // Send notifications to category responsible staff (after commit)
            $this->sendNotificationsToCategoryStaff($order, array_unique($categoryIds));

            return response()->json([
                'success' => true,
                'message' => 'Siparişiniz başarıyla oluşturuldu.',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sipariş oluşturulurken hata: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sipariş oluşturulurken bir hata oluştu.'
            ], 500);
        }
    }

    /**
     * Send notifications to staff assigned to categories
     * Only sends to users with availability_status = 'busy'
     */
    private function sendNotificationsToCategoryStaff(Order $order, array $categoryIds)
    {
        if (empty($categoryIds)) {
            return;
        }

        try {
            // Get categories with their assigned users (only busy users with player_id)
            $categories = Category::whereIn('id', $categoryIds)
                ->with(['users' => function ($query) {
                    $query->whereNotNull('player_id')
                        ->where('player_id', '!=', '')
                        ->where('availability_status', 'busy');
                }])
                ->get();

            foreach ($categories as $category) {
                // Get player IDs of users assigned to this category
                $playerIds = $category->users->pluck('player_id')->filter()->values()->toArray();

                if (empty($playerIds)) {
                    Log::info("Kategori '{$category->name}' için müsait (busy) personel bulunamadı veya player_id yok.");
                    continue;
                }

                // Send notification
                $title = "Yeni Sipariş - {$category->name}";
                $message = "Oda {$order->room_number} - Sipariş #{$order->order_number}";

                $result = sendOneSignalNotification(
                    $title,
                    $message,
                    $order->id,
                    $playerIds
                );

                Log::info("Bildirim gönderildi - Kategori: {$category->name}", [
                    'order_id' => $order->id,
                    'player_ids' => $playerIds,
                    'result' => $result
                ]);
            }
        } catch (\Exception $e) {
            // Log error but don't fail the order
            Log::error('Bildirim gönderilirken hata: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'category_ids' => $categoryIds
            ]);
        }
    }

    /**
     * Show order complete page
     */
    public function complete($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('items.product')
            ->firstOrFail();

        return view('site.order-complete', compact('order'));
    }
}
