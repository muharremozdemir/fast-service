<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        setPermissionsTeamId($companyId);

        // Açık siparişler
        $openOrders = Order::where('company_id', $companyId)
            ->whereNull('closed_at')
            ->with(['room', 'items'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Online personel listesi (availability_status = 'available' ve rolü olan kullanıcılar)
        $onlineStaff = User::where('company_id', $companyId)
            ->where('availability_status', 'available')
            ->get();

        // Siparişi olan odalar (açık siparişlerden)
        $roomsWithOrders = Room::where('company_id', $companyId)
            ->whereHas('orders', function($query) {
                $query->whereNull('closed_at');
            })
            ->with(['floor'])
            ->get();

        // O anki toplam ciro (açık siparişlerin toplamı)
        $totalRevenue = Order::where('company_id', $companyId)
            ->whereNull('closed_at')
            ->sum('total');

        // Oda oda cirolar (açık siparişlerden)
        $revenueByRoomData = Order::where('company_id', $companyId)
            ->whereNull('closed_at')
            ->select('room_id', 'room_number', DB::raw('SUM(total) as revenue'), DB::raw('COUNT(*) as order_count'))
            ->groupBy('room_id', 'room_number')
            ->orderBy('revenue', 'desc')
            ->get();

        $roomIds = $revenueByRoomData->pluck('room_id')->filter()->unique();
        $rooms = Room::whereIn('id', $roomIds)->with('floor')->get()->keyBy('id');

        $revenueByRoom = $revenueByRoomData->map(function($item) use ($rooms) {
            return [
                'room_id' => $item->room_id,
                'room_number' => $item->room_number,
                'revenue' => $item->revenue,
                'order_count' => $item->order_count,
                'room' => $rooms->get($item->room_id),
            ];
        });

        return view('admin.dashboard.index', compact(
            'openOrders',
            'onlineStaff',
            'roomsWithOrders',
            'totalRevenue',
            'revenueByRoom'
        ));
    }
}

