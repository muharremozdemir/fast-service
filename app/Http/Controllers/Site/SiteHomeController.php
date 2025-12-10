<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QrSticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteHomeController extends Controller
{
    /**
     * Landing page - Ana sayfa
     */
    public function landing()
    {
        return view('site.landing');
    }
   
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        return view('site.index', compact('categories'));
    }

    /**
     * Handle QR code scan - set room number from UUID
     */
    public function qrScan($uuid)
    {
        $qrSticker = QrSticker::where('uuid', $uuid)
            ->with('room')
            ->first();

        if (!$qrSticker || !$qrSticker->room) {
            return redirect()->route('site.home')
                ->with('error', 'Geçersiz QR kod. Lütfen tekrar deneyin.');
        }

        // Set room number in session
        Session::put('room_number', $qrSticker->room->room_number);

        return redirect()->route('site.home')
            ->with('success', 'Oda numaranız seçildi: ' . $qrSticker->room->room_number);
    }
    
}
