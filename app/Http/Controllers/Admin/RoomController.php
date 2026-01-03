<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Floor;
use App\Models\Block;
use App\Models\User;
use App\Models\Category;
use App\Models\QrSticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RoomController extends Controller
{
    /**
     * Check if onboarding is needed and redirect if necessary
     */
    private function checkOnboarding()
    {
        $companyId = Auth::user()->company_id;
        $hasBlocks = Block::where('company_id', $companyId)->exists();
        $hasFloors = Floor::where('company_id', $companyId)->exists();
        $hasRooms = Room::where('company_id', $companyId)->exists();

        if (!$hasBlocks || !$hasFloors || !$hasRooms) {
            return redirect()->route('admin.onboarding.welcome');
        }

        return null;
    }

    public function index(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
            ->with(['floor', 'users'])
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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $companyId = Auth::user()->company_id;
        $floors = Floor::where('company_id', $companyId)->where('is_active', true)->orderBy('floor_number')->get();
        $categories = Category::where('company_id', $companyId)->where('is_active', true)->orderBy('name')->get();
        return view('admin.room.add-room', compact('floors', 'categories'));
    }

    public function edit($id)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $companyId = Auth::user()->company_id;
        $room = Room::where('company_id', $companyId)->with(['floor', 'users'])->findOrFail($id);
        $floors = Floor::where('company_id', $companyId)->where('is_active', true)->orderBy('floor_number')->get();
        $categories = Category::where('company_id', $companyId)->where('is_active', true)->orderBy('name')->get();

        // Odaya atanmış kullanıcıları kategori bazında grupla
        $assignedCategoryUsers = [];
        foreach ($room->users as $user) {
            $categoryId = $user->pivot->category_id;
            if ($categoryId) {
                if (!isset($assignedCategoryUsers[$categoryId])) {
                    $assignedCategoryUsers[$categoryId] = [];
                }
                $assignedCategoryUsers[$categoryId][] = $user->id;
            }
        }

        return view('admin.room.edit-room', compact('room', 'floors', 'categories', 'assignedCategoryUsers'));
    }

    public function update(Request $request, $id)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'category_users' => 'nullable|array',
            'category_users.*.category_id' => 'required|exists:categories,id',
            'category_users.*.user_ids' => 'nullable|array',
            'category_users.*.user_ids.*' => 'exists:users,id',
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

        $room->save();

        // Tüm kategori bazlı kullanıcı atamalarını kaldır
        $room->users()->detach();

        // Yeni kategori bazlı kullanıcı atamalarını yap
        $categoryUsers = $request->input('category_users', []);
        foreach ($categoryUsers as $categoryUser) {
            $categoryId = $categoryUser['category_id'] ?? null;
            $userIds = $categoryUser['user_ids'] ?? [];

            if ($categoryId && !empty($userIds)) {
                foreach ($userIds as $userId) {
                    $room->users()->attach($userId, ['category_id' => $categoryId]);
                }
            }
        }

        return redirect()
            ->route('admin.rooms.edit', $room->id)
            ->with('success', 'Oda başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'category_users' => 'nullable|array',
            'category_users.*.category_id' => 'required|exists:categories,id',
            'category_users.*.user_ids' => 'nullable|array',
            'category_users.*.user_ids.*' => 'exists:users,id',
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
        $room->company_id = Auth::user()->company_id;

        $room->save();

        // Kategori bazlı kullanıcı atamalarını yap
        $categoryUsers = $request->input('category_users', []);
        foreach ($categoryUsers as $categoryUser) {
            $categoryId = $categoryUser['category_id'] ?? null;
            $userIds = $categoryUser['user_ids'] ?? [];

            if ($categoryId && !empty($userIds)) {
                foreach ($userIds as $userId) {
                    $room->users()->attach($userId, ['category_id' => $categoryId]);
                }
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Oda başarıyla eklendi.');
    }

    public function destroy(Room $room)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $room = Room::where('company_id', Auth::user()->company_id)
            ->with(['floor', 'orders.items.product'])
            ->withCount('orders')
            ->findOrFail($id);

        $closed = $request->input('closed');

        $orders = $room->orders()
            ->with(['items.product', 'items.notifiedUsers'])
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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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

    /**
     * Get users by category ID
     */
    public function getUsersByCategory(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $companyId = Auth::user()->company_id;
        $categoryId = $request->input('category_id');

        // Kategoriye ait kullanıcıları getir
        $category = Category::where('company_id', $companyId)
            ->findOrFail($categoryId);

        $users = $category->users()
            ->where('users.company_id', $companyId)
            ->orderBy('users.name_surname')
            ->get(['users.id', 'users.name_surname', 'users.email']);

        return response()->json([
            'success' => true,
            'users' => $users,
        ]);
    }

    /**
     * Download Excel template for room import
     */
    public function downloadTemplate()
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $companyId = Auth::user()->company_id;
        $floors = Floor::where('company_id', $companyId)
            ->where('is_active', true)
            ->orderBy('floor_number')
            ->get();

        // Örnek veri
        $sampleData = [
            [
                'floor_name' => $floors->first() ? $floors->first()->name : 'Örnek Kat',
                'room_number' => '101',
                'name' => 'Örnek Oda 1',
                'description' => 'Örnek açıklama',
                'is_active' => '1',
                'sort_order' => '1',
            ],
            [
                'floor_name' => $floors->first() ? $floors->first()->name : 'Örnek Kat',
                'room_number' => '102',
                'name' => 'Örnek Oda 2',
                'description' => '',
                'is_active' => '1',
                'sort_order' => '2',
            ],
        ];

        $template = new class($sampleData) implements FromArray, WithHeadings, WithStyles, ShouldAutoSize {
            protected $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                return $this->data;
            }

            public function headings(): array
            {
                return [
                    'Kat Adı',
                    'Oda Numarası',
                    'Oda Adı (Opsiyonel)',
                    'Açıklama (Opsiyonel)',
                    'Aktif (1 veya 0)',
                    'Sıralama (Opsiyonel)',
                ];
            }

            public function styles(Worksheet $sheet)
            {
                return [
                    1 => ['font' => ['bold' => true]],
                ];
            }
        };

        return Excel::download($template, 'oda_import_sablonu.xlsx');
    }

    /**
     * Import rooms from Excel file
     */
    public function import(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        $companyId = Auth::user()->company_id;

        try {
            $rows = Excel::toArray([], $request->file('file'));
            
            if (empty($rows) || empty($rows[0])) {
                return redirect()
                    ->back()
                    ->with('error', 'Excel dosyası boş veya geçersiz.');
            }

            $data = $rows[0];
            $headers = array_shift($data); // İlk satırı (başlıkları) çıkar

            $imported = 0;
            $updated = 0;
            $errors = [];

            foreach ($data as $index => $row) {
                $rowNumber = $index + 2; // Excel satır numarası (başlık + 1)

                // Satır boşsa atla
                if (empty(array_filter($row))) {
                    continue;
                }

                // Veriyi parse et
                $floorName = $row[0] ?? null;
                $roomNumber = $row[1] ?? null;
                $name = $row[2] ?? null;
                $description = $row[3] ?? null;
                $isActive = isset($row[4]) ? (($row[4] == '1' || $row[4] == 1 || strtolower($row[4]) == 'true') ? 1 : 0) : 1;
                $sortOrder = isset($row[5]) && is_numeric($row[5]) ? (int)$row[5] : 0;

                // Validasyon
                if (empty($floorName) || empty($roomNumber)) {
                    $errors[] = "Satır {$rowNumber}: Kat adı ve oda numarası zorunludur.";
                    continue;
                }

                // Katı bul
                $floor = Floor::where('company_id', $companyId)
                    ->where('name', $floorName)
                    ->where('is_active', true)
                    ->first();

                if (!$floor) {
                    $errors[] = "Satır {$rowNumber}: '{$floorName}' adında aktif bir kat bulunamadı.";
                    continue;
                }

                // Aynı katta aynı oda numarası kontrolü
                $existingRoom = Room::where('company_id', $companyId)
                    ->where('floor_id', $floor->id)
                    ->where('room_number', $roomNumber)
                    ->first();

                if ($existingRoom) {
                    // Güncelle
                    $existingRoom->name = $name ?: $existingRoom->name;
                    $existingRoom->description = $description ?: $existingRoom->description;
                    $existingRoom->is_active = $isActive;
                    $existingRoom->sort_order = $sortOrder;
                    $existingRoom->save();
                    $updated++;
                } else {
                    // Yeni oda oluştur
                    Room::create([
                        'company_id' => $companyId,
                        'floor_id' => $floor->id,
                        'room_number' => $roomNumber,
                        'name' => $name,
                        'description' => $description,
                        'is_active' => $isActive,
                        'sort_order' => $sortOrder,
                    ]);
                    $imported++;
                }
            }

            $message = "İçe aktarma tamamlandı. {$imported} yeni oda eklendi, {$updated} oda güncellendi.";
            if (!empty($errors)) {
                $message .= " " . count($errors) . " hata oluştu.";
                session()->flash('import_errors', $errors);
            }

            return redirect()
                ->back()
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'İçe aktarma sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Preview Excel file and get row count
     */
    public function previewExcel(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return response()->json(['error' => 'Yetki hatası'], 403);
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            $rows = Excel::toArray([], $request->file('file'));
            
            if (empty($rows) || empty($rows[0])) {
                return response()->json([
                    'error' => 'Excel dosyası boş veya geçersiz.'
                ], 400);
            }

            $data = $rows[0];
            $headerRow = array_shift($data); // İlk satırı (başlıkları) çıkar
            
            // Boş satırları filtrele
            $validRows = array_filter($data, function($row) {
                return !empty(array_filter($row));
            });

            $rowCount = count($validRows);

            return response()->json([
                'success' => true,
                'row_count' => $rowCount,
                'total_rows' => count($data) + 1, // +1 for header
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Dosya okuma hatası: ' . $e->getMessage()
            ], 400);
        }
    }
}
