<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Get orders for the authenticated user
     * Returns orders where user is notified (assigned to category of order items)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $user = User::query()->find(5);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        // Get order items where user is notified
        $orderItems = OrderItem::whereHas('notifiedUsers', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->with(['order.room', 'product.category', 'notifiedUsers' => function ($query) {
            $query->select('users.id', 'users.name_surname', 'users.email', 'users.phone');
        }])
        ->whereHas('order', function ($query) use ($user) {
            $query->where('company_id', $user->company_id);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        // Group by order
        $orders = $orderItems->groupBy('order_id')->map(function ($items) {
            $order = $items->first()->order;
            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'room_number' => $order->room_number,
                'room' => $order->room ? [
                    'id' => $order->room->id,
                    'room_number' => $order->room->room_number,
                ] : null,
                'status' => $order->status,
                'total' => $order->total,
                'notes' => $order->notes,
                'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                'items' => $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product' => [
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'category' => $item->product->category ? [
                                'id' => $item->product->category->id,
                                'name' => $item->product->category->name,
                            ] : null,
                        ],
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'status' => $item->status,
                        'status_label' => $item->status_label,
                        'notified_user_ids' => $item->notifiedUsers->pluck('id')->toArray(),
                        'notified_users' => $item->notifiedUsers->map(function ($user) {
                            return [
                                'id' => $user->id,
                                'name_surname' => $user->name_surname,
                                'email' => $user->email,
                                'phone' => $user->phone,
                            ];
                        }),
                    ];
                }),
            ];
        })->values();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    /**
     * Get a specific order with items
     */
    public function show($id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $order = Order::where('id', $id)
            ->where('company_id', $user->company_id)
            ->with(['items.product.category', 'items.notifiedUsers' => function ($query) {
                $query->select('users.id', 'users.name_surname', 'users.email', 'users.phone');
            }, 'room'])
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Sipariş bulunamadı.'
            ], 404);
        }

        // Check if user is notified for any item in this order
        $userIsNotified = $order->items->some(function ($item) use ($user) {
            return $item->notifiedUsers->contains('id', $user->id);
        });

        if (!$userIsNotified) {
            return response()->json([
                'success' => false,
                'message' => 'Bu siparişe erişim yetkiniz yok.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'room_number' => $order->room_number,
                'room' => $order->room ? [
                    'id' => $order->room->id,
                    'room_number' => $order->room->room_number,
                ] : null,
                'status' => $order->status,
                'total' => $order->total,
                'notes' => $order->notes,
                'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product' => [
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'category' => $item->product->category ? [
                                'id' => $item->product->category->id,
                                'name' => $item->product->category->name,
                            ] : null,
                        ],
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'status' => $item->status,
                        'status_label' => $item->status_label,
                        'notified_user_ids' => $item->notifiedUsers->pluck('id')->toArray(),
                        'notified_users' => $item->notifiedUsers->map(function ($user) {
                            return [
                                'id' => $user->id,
                                'name_surname' => $user->name_surname,
                                'email' => $user->email,
                                'phone' => $user->phone,
                            ];
                        }),
                    ];
                }),
            ],
        ]);
    }

    /**
     * Update order item status
     */
    public function updateItemStatus(Request $request, $orderItemId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $orderItem = OrderItem::whereHas('notifiedUsers', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->whereHas('order', function ($query) use ($user) {
            $query->where('company_id', $user->company_id);
        })
        ->find($orderItemId);

        if (!$orderItem) {
            return response()->json([
                'success' => false,
                'message' => 'Sipariş kalemi bulunamadı veya bu işlemi yapmaya yetkiniz yok.'
            ], 404);
        }

        $orderItem->status = $request->status;
        $orderItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Durum başarıyla güncellendi.',
            'data' => [
                'id' => $orderItem->id,
                'status' => $orderItem->status,
                'status_label' => $orderItem->status_label,
            ],
        ]);
    }
}
