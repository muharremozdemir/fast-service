<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\DemoRequestMail;
use App\Models\Category;
use App\Models\QrSticker;
use App\Models\Room;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        // Company bilgisini al (room_number'dan)
        $company = null;
        $sliders = collect();
        $roomNumber = Session::get('room_number');
        if ($roomNumber) {
            $room = Room::where('room_number', $roomNumber)->first();
            if ($room && $room->company) {
                $company = $room->company;
                // Company'ye ait aktif slider'ları çek
                $sliders = Slider::where('company_id', $company->id)
                    ->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        return view('site.index', compact('categories', 'company', 'sliders'));
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

    /**
     * Handle demo request form submission
     */
    public function submitDemoRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'package' => 'nullable|string|in:standart,premium',
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            // Send email to iletisim@muharremozdemir.com
            Mail::to('iletisim@muharremozdemir.com')->send(
                new DemoRequestMail(
                    $validated['name'],
                    $validated['email'],
                    $validated['phone'],
                    $validated['company'] ?? null,
                    $validated['package'] ?? null,
                    $validated['message'] ?? null
                )
            );

            return response()->json([
                'success' => true,
                'message' => 'Demo talebiniz başarıyla gönderildi! En kısa sürede size dönüş yapacağız.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Demo request mail error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
            ], 500);
        }
    }
    
}
