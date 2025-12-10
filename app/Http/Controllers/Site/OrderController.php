<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            // Calculate total
            $total = $cart->items()->with('product')->get()->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Find room by room_number
            $room = Room::where('room_number', $roomNumber)
                ->where('is_active', true)
                ->first();

            // Create order
            $order = Order::create([
                'room_id' => $room ? $room->id : null,
                'room_number' => $roomNumber,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'total' => $total,
                'notes' => $request->input('notes'),
            ]);

            // Create order items
            foreach ($cart->items()->with('product')->get() as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Siparişiniz başarıyla oluşturuldu.',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Sipariş oluşturulurken bir hata oluştu.'
            ], 500);
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
