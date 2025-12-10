<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Floor;
use App\Models\User;
use App\Models\QrSticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
        $floor_id = $request->input('floor_id');
        $perPage = $request->input('per_page', 10);
    
        // Validate per_page value
        $allowedPerPage = [10, 25, 50, 100, -1]; // -1 means all
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
    
        $query = Room::query()
            ->where('company_id', Auth::user()->company_id)
            ->with(['floor', 'user'])
            ->withCount('orders')
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('room_number', 'like', "%{$q}%")
                          ->orWhere('name', 'like', "%{$q}%");
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->when($floor_id, function ($query, $floor_id) {
                $query->where('floor_id', $floor_id);
            })
            ->orderBy('floor_id')
            ->orderBy('sort_order')
            ->orderBy('room_number');
    
        // If per_page is -1, get all without pagination
        if ($perPage == -1) {
            $rooms = $query->get();
            // Create a custom paginator-like object for compatibility
            $rooms = new \Illuminate\Pagination\LengthAwarePaginator(
                $rooms,
                $rooms->count(),
                $rooms->count(),
                1,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            $rooms = $query->paginate($perPage)->withQueryString();
        }
    
        $floors = Floor::where('is_active', true)->orderBy('floor_number')->get();
    
        return view('admin.room.rooms', compact('rooms', 'floors', 'q', 'status', 'floor_id', 'perPage'));
    }

    public function create()
    {
        $companyId = Auth::user()->company_id;
        $floors = Floor::where('company_id', $companyId)->where('is_active', true)->orderBy('floor_number')->get();
        $staff = User::where('company_id', $companyId)->orderBy('name')->get();
        return view('admin.room.add-room', compact('floors', 'staff'));
    }

    public function edit($id)
    {
        $companyId = Auth::user()->company_id;
        $room = Room::where('company_id', $companyId)->with('floor')->findOrFail($id);
        $floors = Floor::where('company_id', $companyId)->where('is_active', true)->orderBy('floor_number')->get();
        $staff = User::where('company_id', $companyId)->orderBy('name')->get();
        return view('admin.room.edit-room', compact('room', 'floors', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $room = Room::where('company_id', Auth::user()->company_id)->findOrFail($id);
        
        // Aynı katta aynı oda numarası kontrolü
        $existingRoom = Room::where('company_id', Auth::user()->company_id)
            ->where('floor_id', $request->input('floor_id'))
            ->where('room_number', $request->input('room_number'))
            ->where('id', '!=', $id)
            ->first();
            
        if ($existingRoom) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['room_number' => 'Bu katta bu oda numarası zaten mevcut.']);
        }

        $room->floor_id = $request->input('floor_id');
        $room->room_number = $request->input('room_number');
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        $room->is_active = $request->input('is_active', 0);
        $room->sort_order = $request->input('sort_order', 0);
        $room->user_id = $request->input('user_id');

        $room->save();

        return redirect()
            ->route('admin.rooms.edit', $room->id)
            ->with('success', 'Oda başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Aynı katta aynı oda numarası kontrolü
        $existingRoom = Room::where('company_id', Auth::user()->company_id)
            ->where('floor_id', $request->input('floor_id'))
            ->where('room_number', $request->input('room_number'))
            ->first();
            
        if ($existingRoom) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['room_number' => 'Bu katta bu oda numarası zaten mevcut.']);
        }

        $room = new Room();
        $room->floor_id = $request->input('floor_id');
        $room->room_number = $request->input('room_number');
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        $room->sort_order = $request->input('sort_order', 0);
        $room->is_active = $request->input('is_active');
        $room->user_id = $request->input('user_id');
        $room->company_id = Auth::user()->company_id;

        $room->save();

        return redirect()->route('admin.rooms.index')->with('success', 'Oda başarıyla eklendi.');
    }

    public function destroy(Room $room)
    {
        if ($room->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu odaya erişim yetkiniz yok.');
        }
        $room->delete();
    
        return redirect()
            ->back()
            ->with('success', 'Oda başarıyla silindi.');
    }

    public function show($id, Request $request)
    {
        $room = Room::where('company_id', Auth::user()->company_id)
            ->with(['floor', 'orders.items.product'])
            ->withCount('orders')
            ->findOrFail($id);
        
        $closed = $request->input('closed');
        
        $orders = $room->orders()
            ->with('items.product')
            ->when($closed === '1', function ($query) {
                $query->closed();
            })
            ->when($closed === '0', function ($query) {
                $query->open();
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
    
        return view('admin.room.show-room', compact('room', 'orders', 'closed'));
    }

    public function bulkAssignStaff(Request $request)
    {
        $request->validate([
            'room_ids' => 'required|array',
            'room_ids.*' => 'exists:rooms,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $roomIds = $request->input('room_ids');
        $userId = $request->input('user_id');
        $companyId = Auth::user()->company_id;

        Room::where('company_id', $companyId)->whereIn('id', $roomIds)->update(['user_id' => $userId]);

        $count = count($roomIds);
        $message = $userId 
            ? "{$count} oda için görevli atandı." 
            : "{$count} oda için görevli ataması kaldırıldı.";

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * Generate or get QR code for a room
     */
    public function generateQrCode($id)
    {
        $room = Room::where('company_id', Auth::user()->company_id)->findOrFail($id);

        // Get or create QR sticker for this room
        $qrSticker = QrSticker::firstOrCreate(
            ['room_id' => $room->id],
            ['uuid' => \Illuminate\Support\Str::uuid()]
        );

        // Generate QR code URL
        $qrUrl = route('site.qr.scan', ['uuid' => $qrSticker->uuid]);

        // Generate QR code as SVG
        $qrCode = QrCode::size(300)
            ->format('svg')
            ->generate($qrUrl);

        return view('admin.room.qr-code', compact('room', 'qrSticker', 'qrUrl', 'qrCode'));
    }

    /**
     * Download QR code as SVG
     */
    public function downloadQrCode($id)
    {
        $room = Room::where('company_id', Auth::user()->company_id)->findOrFail($id);

        // Get or create QR sticker for this room
        $qrSticker = QrSticker::firstOrCreate(
            ['room_id' => $room->id],
            ['uuid' => \Illuminate\Support\Str::uuid()]
        );

        // Generate QR code URL
        $qrUrl = route('site.qr.scan', ['uuid' => $qrSticker->uuid]);

        // Generate QR code as SVG (doesn't require imagick extension)
        $qrCode = QrCode::size(500)
            ->format('svg')
            ->generate($qrUrl);

        $filename = 'qr-code-' . $room->room_number . '.svg';

        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Bulk print QR codes for selected rooms
     */
    public function bulkPrintQr(Request $request)
    {
        $request->validate([
            'room_ids' => 'required|array',
            'room_ids.*' => 'exists:rooms,id',
        ]);

        $roomIds = $request->input('room_ids');
        $companyId = Auth::user()->company_id;
        $rooms = Room::where('company_id', $companyId)
            ->whereIn('id', $roomIds)
            ->with(['floor', 'qrSticker'])
            ->orderBy('floor_id')
            ->orderBy('room_number')
            ->get();

        // Ensure QR stickers exist for all rooms
        foreach ($rooms as $room) {
            if (!$room->qrSticker) {
                QrSticker::create([
                    'room_id' => $room->id,
                ]);
            }
        }

        // Reload rooms with QR stickers
        $rooms = Room::where('company_id', $companyId)
            ->whereIn('id', $roomIds)
            ->with(['floor', 'qrSticker', 'company'])
            ->orderBy('floor_id')
            ->orderBy('room_number')
            ->get();

        // Get company info from first room
        $company = $rooms->first()?->company;

        // Generate QR codes for each room
        $qrCodes = [];
        foreach ($rooms as $room) {
            $qrSticker = $room->qrSticker;
            if ($qrSticker) {
                $qrUrl = route('site.qr.scan', ['uuid' => $qrSticker->uuid]);
                $qrCode = QrCode::size(150)
                    ->format('svg')
                    ->generate($qrUrl);
                
                $qrCodes[] = [
                    'room' => $room,
                    'qrCode' => $qrCode,
                    'qrUrl' => $qrUrl,
                ];
            }
        }

        return view('admin.room.bulk-print-qr', compact('qrCodes', 'company'));
    }
}
