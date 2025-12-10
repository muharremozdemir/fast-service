<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', 'daily'); // daily, monthly, 6months, yearly
        
        $data = $this->getReportData($period);
        
        return view('admin.report.reports', compact('data', 'period'));
    }

    private function getReportData($period)
    {
        $now = Carbon::now();
        $companyId = Auth::user()->company_id;
        
        switch ($period) {
            case 'daily':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $label = 'Günlük Rapor (' . $now->format('d.m.Y') . ')';
                break;
            case 'monthly':
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                $months = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
                $label = 'Aylık Rapor (' . $months[$now->month - 1] . ' ' . $now->year . ')';
                break;
            case '6months':
                $startDate = $now->copy()->subMonths(6)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $label = '6 Aylık Rapor';
                break;
            case 'yearly':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                $label = 'Yıllık Rapor (' . $now->format('Y') . ')';
                break;
            default:
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $label = 'Günlük Rapor';
        }

        // Temel istatistikler
        $orders = Order::where('company_id', $companyId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('closed_at')
            ->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total');
        $averageOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // En çok satan ürünler
        $topProducts = OrderItem::whereHas('order', function ($query) use ($startDate, $endDate, $companyId) {
                $query->where('company_id', $companyId)
                      ->whereBetween('created_at', [$startDate, $endDate])
                      ->whereNotNull('closed_at');
            })
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(quantity * price) as total_revenue'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        // Oda bazlı istatistikler
        $roomStats = Order::where('company_id', $companyId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('closed_at')
            ->select('room_number', 
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(total) as total_revenue')
            )
            ->groupBy('room_number')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();

        // Günlük/haftalık trend (sadece aylık ve yıllık için)
        $trendData = [];
        if ($period === 'monthly' || $period === 'yearly') {
            $groupBy = $period === 'monthly' ? 'day' : 'week';
            
            if ($groupBy === 'day') {
                $trend = Order::where('company_id', $companyId)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->whereNotNull('closed_at')
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as order_count'),
                        DB::raw('SUM(total) as revenue')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
            } else {
                // Yıllık rapor için haftalık trend
                $trend = Order::where('company_id', $companyId)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->whereNotNull('closed_at')
                    ->get()
                    ->groupBy(function ($order) {
                        return $order->created_at->format('Y-W'); // Yıl-Hafta
                    })
                    ->map(function ($orders, $weekKey) {
                        return (object) [
                            'week' => $weekKey,
                            'order_count' => $orders->count(),
                            'revenue' => $orders->sum('total'),
                        ];
                    })
                    ->values()
                    ->sortBy('week');
            }
            
            $trendData = $trend->map(function ($item) {
                if (isset($item->date)) {
                    $label = Carbon::parse($item->date)->format('d.m.Y');
                } else {
                    // Hafta formatı: 2025-48 -> "48. Hafta (2025)"
                    $parts = explode('-', $item->week);
                    $label = $parts[1] . '. Hafta (' . $parts[0] . ')';
                }
                
                return [
                    'label' => $label,
                    'orders' => $item->order_count,
                    'revenue' => (float) $item->revenue,
                ];
            })->values();
        }

        // Kategori bazlı satışlar
        $categoryStats = OrderItem::whereHas('order', function ($query) use ($startDate, $endDate, $companyId) {
                $query->where('company_id', $companyId)
                      ->whereBetween('created_at', [$startDate, $endDate])
                      ->whereNotNull('closed_at');
            })
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'categories.name as category_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_revenue')
            ->get();

        return [
            'label' => $label,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'averageOrder' => $averageOrder,
            'topProducts' => $topProducts,
            'roomStats' => $roomStats,
            'trendData' => $trendData,
            'categoryStats' => $categoryStats,
        ];
    }
}
