<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Get or create cart for room number
     */
    private function getOrCreateCart(string $roomNumber): Cart
    {
        return Cart::firstOrCreate(['room_number' => $roomNumber]);
    }

    /**
     * Get room number from session or request
     */
    private function getRoomNumber(Request $request): ?string
    {
        return $request->input('room_number') ?? Session::get('room_number');
    }

    /**
     * Display cart page
     */
    public function index()
    {
        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber) {
            return redirect()->route('site.home')->with('error', 'Lütfen önce oda numaranızı girin.');
        }

        // Company bilgisini al
        $company = null;
        $room = Room::where('room_number', $roomNumber)->first();
        if ($room && $room->company) {
            $company = $room->company;
        }

        $cart = Cart::where('room_number', $roomNumber)->first();
        
        if (!$cart) {
            $cartItems = collect();
            $total = 0;
        } else {
            $cartItems = $cart->items()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        }

        return view('site.cart', compact('cartItems', 'total', 'roomNumber', 'company'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'room_number' => 'nullable|string',
        ]);

        $roomNumber = $this->getRoomNumber($request);
        
        if (!$roomNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen önce oda numaranızı girin.'
            ], 400);
        }

        $cart = $this->getOrCreateCart($roomNumber);
        $product = Product::findOrFail($request->product_id);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $cartCount = $cart->items()->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepete eklendi.',
            'cart_count' => $cartCount,
            'cart_item_id' => $cartItem->id,
            'quantity' => $cartItem->quantity,
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber || $cartItem->cart->room_number !== $roomNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Yetkisiz işlem.'
            ], 403);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $cart = $cartItem->cart;
        $total = $cart->items()->with('product')->get()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return response()->json([
            'success' => true,
            'item_total' => $cartItem->quantity * $cartItem->product->price,
            'total' => $total,
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(CartItem $cartItem)
    {
        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber || $cartItem->cart->room_number !== $roomNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Yetkisiz işlem.'
            ], 403);
        }

        $cart = $cartItem->cart;
        $cartItem->delete();

        $total = $cart->items()->with('product')->get()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return response()->json([
            'success' => true,
            'total' => $total,
        ]);
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Oda numarası bulunamadı.'
            ], 400);
        }

        $cart = Cart::where('room_number', $roomNumber)->first();
        
        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sepet temizlendi.',
        ]);
    }

    /**
     * Set room number
     */
    public function setRoomNumber(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:50',
        ]);

        Session::put('room_number', $request->room_number);

        return response()->json([
            'success' => true,
            'message' => 'Oda numarası kaydedildi.',
            'room_number' => $request->room_number,
        ]);
    }

    /**
     * Get cart count
     */
    public function getCount()
    {
        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber) {
            return response()->json([
                'count' => 0,
            ]);
        }

        $cart = Cart::where('room_number', $roomNumber)->first();
        
        if (!$cart) {
            return response()->json([
                'count' => 0,
            ]);
        }

        $count = $cart->items()->sum('quantity');

        return response()->json([
            'count' => $count,
        ]);
    }

    /**
     * Get active rooms list
     */
    public function getRooms()
    {
        $rooms = Room::where('is_active', true)
            ->with('floor')
            ->orderBy('floor_id')
            ->orderBy('room_number')
            ->get()
            ->map(function ($room) {
                return [
                    'id' => $room->id,
                    'room_number' => $room->room_number,
                    'name' => $room->name,
                    'floor_name' => $room->floor->name ?? '',
                    'display_text' => $room->room_number . ($room->name ? ' - ' . $room->name : '') . ($room->floor ? ' (' . $room->floor->name . ')' : ''),
                ];
            });

        return response()->json([
            'success' => true,
            'rooms' => $rooms,
        ]);
    }
}
