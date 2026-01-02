<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Room;
use App\Models\Category;
use App\Services\OneSignalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private OneSignalService $oneSignalService;

    /**
     * @param OneSignalService $oneSignalService
     */
    public function __construct(OneSignalService $oneSignalService)
    {
        $this->oneSignalService = $oneSignalService;
    }

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

                    // Get users assigned to this room AND category combination
                    $roomUsers = $room->usersByCategory($cartItem->product->category_id)->get();
                    if ($roomUsers->isNotEmpty()) {
                        $userIds = $roomUsers->pluck('id')->toArray();
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
     * Send notifications to staff assigned to room and category combination
     * Only sends to users with availability_status = 'available' and valid player_id
     */
    private function sendNotificationsToCategoryStaff(Order $order, array $categoryIds)
    {
        if (empty($categoryIds)) {
            return;
        }

        try {
            // Get room with its relationships
            $room = Room::find($order->room_id);
            
            if (!$room) {
                Log::warning("Sipariş için oda bulunamadı", ['order_id' => $order->id]);
                return;
            }

            // Get unique category IDs
            $uniqueCategoryIds = array_unique($categoryIds);
            
            // Get categories
            $categories = Category::whereIn('id', $uniqueCategoryIds)->get();

            foreach ($categories as $category) {
                // Get users assigned to this room AND category combination
                // Filter only available users with player_id
                $roomUsers = $room->usersByCategory($category->id)
                    ->whereNotNull('player_id')
                    ->where('player_id', '!=', '')
                    ->where('availability_status', 'available')
                    ->get();

                if ($roomUsers->isEmpty()) {
                    Log::info("Oda {$order->room_number} - Kategori '{$category->name}' için müsait personel bulunamadı veya player_id yok.");
                    continue;
                }

                // Get player IDs of users assigned to this room-category combination
                $playerIds = $roomUsers->pluck('player_id')->filter()->values()->toArray();

                if (empty($playerIds)) {
                    Log::info("Oda {$order->room_number} - Kategori '{$category->name}' için geçerli player_id bulunamadı.");
                    continue;
                }

                // Send notification
                $title = "Yeni Sipariş - {$category->name}";
                $message = "Oda {$order->room_number} - Sipariş #{$order->order_number}";

                // Flutter tarafında deep linking için data ekle
                $data = [
                    'type' => 'order',
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'room_number' => $order->room_number,
                    'action' => 'open_order',
                ];

                $result = $this->oneSignalService->sendNotification($title, $message, $playerIds, $data);

                Log::info("Bildirim gönderildi - Oda: {$order->room_number}, Kategori: {$category->name}", [
                    'order_id' => $order->id,
                    'room_id' => $room->id,
                    'category_id' => $category->id,
                    'player_ids' => $playerIds,
                    'user_count' => count($playerIds),
                    'result' => $result
                ]);
            }
        } catch (\Exception $e) {
            // Log error but don't fail the order
            Log::error('Bildirim gönderilirken hata: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'room_id' => $order->room_id,
                'category_ids' => $categoryIds,
                'trace' => $e->getTraceAsString()
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
