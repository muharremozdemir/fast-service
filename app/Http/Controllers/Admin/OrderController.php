<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OneSignalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private OneSignalService $oneSignalService;

    public function __construct(OneSignalService $oneSignalService)
    {
        $this->oneSignalService = $oneSignalService;
    }

    public function index(Request $request)
    {
        // Datatable için JSON response
        if ($request->ajax()) {
            $companyId = Auth::user()->company_id;
            $query = Order::where('company_id', $companyId)->with('items.product');

            // Toplam kayıt sayısı (filtreleme öncesi)
            $totalRecords = Order::where('company_id', $companyId)->count();

            // DataTables arama (search[value])
            $searchValue = $request->input('search.value');
            if (!empty($searchValue)) {
                $query->where(function ($q) use ($searchValue) {
                    $q->where('order_number', 'like', "%{$searchValue}%")
                      ->orWhere('room_number', 'like', "%{$searchValue}%")
                      ->orWhere('notes', 'like', "%{$searchValue}%");
                });
            }

            // Özel filtreler (filtre menüsünden)
            if ($request->filled('status')) {
                $query->where('status', $request->input('status'));
            }

            if ($request->filled('closed')) {
                if ($request->input('closed') === '1') {
                    $query->closed();
                } else {
                    $query->open();
                }
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->input('date_from'));
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->input('date_to'));
            }

            if ($request->filled('room_number')) {
                $query->where('room_number', $request->input('room_number'));
            }

            // Filtrelenmiş kayıt sayısı
            $filteredRecords = $query->count();

            // Sıralama
            $orderColumn = $request->input('order.0.column', 5);
            $orderDir = $request->input('order.0.dir', 'desc');

            $columns = ['order_number', 'room_number', 'status', 'total', 'items_count', 'created_at'];
            $sortBy = $columns[$orderColumn] ?? 'created_at';

            $query->orderBy($sortBy, $orderDir);

            // Sayfalama
            $start = $request->input('start', 0);
            $length = $request->input('length', 10);
            $orders = $query->skip($start)->take($length)->get();

            $data = $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'room_number' => $order->room_number,
                    'status' => $order->status,
                    'status_label' => $this->getStatusLabel($order->status),
                    'total' => number_format($order->total, 2, ',', '.') . ' ₺',
                    'items_count' => $order->items->count(),
                    'notes' => $order->notes,
                    'is_closed' => $order->isClosed(),
                    'closed_at' => $order->closed_at ? $order->closed_at->format('d.m.Y H:i') : null,
                    'created_at' => $order->created_at->format('d.m.Y H:i'),
                    'updated_at' => $order->updated_at->format('d.m.Y H:i'),
                ];
            });

            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        }

        // Normal sayfa yüklemesi için
        return view('admin.order.orders');
    }

    public function show(Order $order)
    {
        // Yetki kontrolü
        if ($order->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu siparişe erişim yetkiniz yok.');
        }

        // Sipariş detaylarını yükle
        $order->load([
            'items.product',
            'items.notifiedUsers',
            'room.floor',
            'company'
        ]);

        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu siparişe erişim yetkiniz yok.');
        }
        // Kapalı siparişlerin durumu değiştirilemez
        if ($order->isClosed()) {
            return response()->json([
                'success' => false,
                'message' => 'Kapalı siparişlerin durumu değiştirilemez.',
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,preparing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Sipariş durumu güncellendi.',
            'status' => $order->status,
            'status_label' => $this->getStatusLabel($order->status),
        ]);
    }

    public function close(Order $order)
    {
        if ($order->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu siparişe erişim yetkiniz yok.');
        }
        if ($order->isClosed()) {
            return response()->json([
                'success' => false,
                'message' => 'Bu sipariş zaten kapatılmış.',
            ], 400);
        }

        $order->closed_at = now();
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Sipariş başarıyla kapatıldı.',
            'closed_at' => $order->closed_at->format('d.m.Y H:i'),
        ]);
    }

    public function reopen(Order $order)
    {
        if ($order->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu siparişe erişim yetkiniz yok.');
        }
        if (!$order->isClosed()) {
            return response()->json([
                'success' => false,
                'message' => 'Bu sipariş zaten açık.',
            ], 400);
        }

        $order->closed_at = null;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Sipariş başarıyla yeniden açıldı.',
        ]);
    }

    public function updateItemStatus(Request $request, OrderItem $orderItem)
    {
        // Yetki kontrolü - siparişin company_id'si kontrol edilir
        if ($orderItem->order->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu sipariş kalemine erişim yetkiniz yok.');
        }

        // Kapalı siparişlerin ürün durumu değiştirilemez
        if ($orderItem->order->isClosed()) {
            return response()->json([
                'success' => false,
                'message' => 'Kapalı siparişlerin ürün durumu değiştirilemez.',
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $orderItem->status = $request->status;
        $orderItem->save();

        // Eğer sipariş içindeki tüm ürünler tamamlandı durumunda ise siparişin ana durumunu da tamamlandı yap
        $order = $orderItem->order;
        $allItemsCompleted = $order->items()->where('status', '!=', 'completed')->doesntExist();
        
        if ($allItemsCompleted) {
            $order->status = 'completed';
            $order->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Ürün durumu güncellendi.',
            'status' => $orderItem->status,
            'status_label' => $orderItem->status_label,
        ]);
    }

    public function sendItemReminder(OrderItem $orderItem)
    {
        // Yetki kontrolü - siparişin company_id'si kontrol edilir
        if ($orderItem->order->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu sipariş kalemine erişim yetkiniz yok.');
        }

        // OrderItem'ı notifiedUsers ile yükle
        $orderItem->load(['notifiedUsers', 'product', 'order']);

        if ($orderItem->notifiedUsers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Bu ürün için atanmış kullanıcı bulunmamaktadır.',
            ], 400);
        }

        // Sadece player_id'si olan ve müsait olan kullanıcıları filtrele
        $usersToNotify = $orderItem->notifiedUsers
            ->whereNotNull('player_id')
            ->where('player_id', '!=', '')
            ->where('availability_status', 'available');

        if ($usersToNotify->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Bildirim gönderebilecek müsait kullanıcı bulunmamaktadır.',
            ], 400);
        }

        $playerIds = $usersToNotify->pluck('player_id')->filter()->values()->toArray();

        if (empty($playerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Geçerli player_id bulunamadı.',
            ], 400);
        }

        // Bildirim mesajı oluştur
        $order = $orderItem->order;
        $productName = $orderItem->product->name ?? 'Ürün';
        $title = "Hatırlatma - {$productName}";
        $message = "Oda {$order->room_number} - Sipariş #{$order->order_number} için hatırlatma";

        // Flutter tarafında deep linking için data ekle
        $data = [
            'type' => 'order_item',
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'order_item_id' => $orderItem->id,
            'room_number' => $order->room_number,
            'action' => 'open_order',
        ];

        // Bildirim gönder
        $result = $this->oneSignalService->sendNotification($title, $message, $playerIds, $data, 'tr');

        Log::info("Hatırlatma bildirimi gönderildi", [
            'order_item_id' => $orderItem->id,
            'order_id' => $order->id,
            'product_name' => $productName,
            'room_number' => $order->room_number,
            'player_ids' => $playerIds,
            'user_count' => count($playerIds),
            'result' => $result
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hatırlatma bildirimi başarıyla gönderildi.',
            'notified_count' => count($playerIds),
        ]);
    }

    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'Beklemede',
            'preparing' => 'Hazırlanıyor',
            'completed' => 'Tamamlandı',
            'cancelled' => 'İptal Edildi',
        ];

        return $labels[$status] ?? $status;
    }
}

