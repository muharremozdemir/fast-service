<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OneSignalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StaffController extends Controller
{
    private OneSignalService $oneSignalService;

    public function __construct(OneSignalService $oneSignalService)
    {
        $this->oneSignalService = $oneSignalService;
    }

    /**
     * Personel listesi
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $sort = $request->input('sort', 'name');
        $perPage = $request->input('per_page', 15);

        $query = User::query()
            ->where('company_id', Auth::user()->company_id)
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name_surname', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%")
                          ->orWhere('phone', 'like', "%{$q}%");
                });
            });

        // Sıralama
        if ($sort === 'name') {
            $query->orderBy('name_surname');
        } elseif ($sort === 'created_desc') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'created_asc') {
            $query->orderBy('created_at', 'asc');
        }

        $users = $query->paginate($perPage)->withQueryString();

        // Her kullanıcının rollerini yükle
        foreach ($users as $user) {
            setPermissionsTeamId($user->company_id);
            $user->load('roles');
        }

        // İstatistikler
        $totalStaff = User::where('company_id', Auth::user()->company_id)->count();
        $staffWithRoles = User::where('company_id', Auth::user()->company_id)
            ->whereHas('roles')
            ->count();
        $staffWithoutRoles = $totalStaff - $staffWithRoles;

        return view('admin.staff.index', compact('users', 'q', 'sort', 'perPage', 'totalStaff', 'staffWithRoles', 'staffWithoutRoles'));
    }

    /**
     * Yeni personel ekleme formu
     */
    public function create()
    {
        // Sadece giriş yapan kullanıcının company_id'sine göre roller
        $roles = Role::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        return view('admin.staff.create', compact('roles'));
    }

    /**
     * Yeni personel kaydet
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:50',
            'roles' => 'nullable|array',
            'roles.*' => [
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    $role = Role::find($value);
                    if ($role && $role->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen rol sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name_surname.required' => 'Ad Soyad gereklidir.',
            'email.required' => 'E-posta gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'phone.required' => 'Telefon numarası gereklidir.',
        ]);

        // Rastgele güvenli şifre oluştur (12 karakter, büyük/küçük harf, rakam ve özel karakter)
        $randomPassword = \Illuminate\Support\Str::random(12);

        $user = User::create([
            'name_surname' => $request->input('name_surname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($randomPassword),
            'company_id' => Auth::user()->company_id,
        ]);

        // Rolleri ata
        if ($request->has('roles')) {
            setPermissionsTeamId(Auth::user()->company_id);

            $roles = Role::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('roles'))
                ->get();

            foreach ($roles as $role) {
                if (!$user->hasRole($role)) {
                    $user->assignRole($role);
                }
            }
        }

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Personel başarıyla eklendi.');
    }

    /**
     * Personel düzenleme formu
     */
    public function edit($id)
    {
        $user = User::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        // Sadece giriş yapan kullanıcının company_id'sine göre roller
        $roles = Role::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        // Kullanıcının mevcut rollerini yükle
        setPermissionsTeamId($user->company_id);
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.staff.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Personel güncelle
     */
    public function update(Request $request, $id)
    {
        $user = User::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:50',
            'roles' => 'nullable|array',
            'roles.*' => [
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    $role = Role::find($value);
                    if ($role && $role->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen rol sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Ad Soyad gereklidir.',
            'email.required' => 'E-posta gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'phone.required' => 'Telefon numarası gereklidir.',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        // Rolleri güncelle
        setPermissionsTeamId(Auth::user()->company_id);

        // Mevcut rolleri kaldır
        $user->roles()->detach();

        // Yeni rolleri ata
        if ($request->has('roles')) {
            $roles = Role::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('roles'))
                ->get();

            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Personel başarıyla güncellendi.');
    }

    /**
     * Personele bildirim gönder
     */
    public function sendNotification(Request $request, $id)
    {
        $user = User::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        // Player ID kontrolü
        if (empty($user->player_id)) {
            return redirect()
                ->route('admin.staff.edit', $id)
                ->with('error', 'Bu kullanıcının bildirim almak için cihaz kaydı bulunmuyor.');
        }

        $request->validate([
            'notification_title' => 'required|string|max:100',
            'notification_content' => 'required|string|max:500',
        ], [
            'notification_title.required' => 'Bildirim başlığı gereklidir.',
            'notification_title.max' => 'Bildirim başlığı en fazla 100 karakter olabilir.',
            'notification_content.required' => 'Bildirim içeriği gereklidir.',
            'notification_content.max' => 'Bildirim içeriği en fazla 500 karakter olabilir.',
        ]);

        $title = $request->input('notification_title');
        $content = $request->input('notification_content');

        // OneSignal ile bildirim gönder
        $result = $this->oneSignalService->sendNotification($title, $content, $user->player_id);

        if (isset($result['error']) && $result['error']) {
            return redirect()
                ->route('admin.staff.edit', $id)
                ->with('error', 'Bildirim gönderilirken bir hata oluştu: ' . ($result['message'] ?? 'Bilinmeyen hata'));
        }

        return redirect()
            ->route('admin.staff.edit', $id)
            ->with('success', 'Bildirim başarıyla gönderildi.');
    }

    /**
     * Download Excel template for staff import
     */
    public function downloadTemplate()
    {
        $companyId = Auth::user()->company_id;
        $roles = Role::where('company_id', $companyId)
            ->orderBy('name')
            ->get();

        // Örnek veri
        $sampleData = [
            [
                'name_surname' => 'Ahmet Yılmaz',
                'email' => 'ahmet.yilmaz@example.com',
                'phone' => '05551234567',
                'roles' => $roles->first() ? $roles->first()->name : 'Örnek Rol',
            ],
            [
                'name_surname' => 'Ayşe Demir',
                'email' => 'ayse.demir@example.com',
                'phone' => '05559876543',
                'roles' => '',
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
                    'Ad Soyad',
                    'E-posta',
                    'Telefon',
                    'Roller (Opsiyonel - Virgülle Ayrılmış)',
                ];
            }

            public function styles(Worksheet $sheet)
            {
                return [
                    1 => ['font' => ['bold' => true]],
                ];
            }
        };

        return Excel::download($template, 'personel_import_sablonu.xlsx');
    }

    /**
     * Preview Excel file and get row count
     */
    public function previewExcel(Request $request)
    {
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

    /**
     * Import staff from Excel file
     */
    public function import(Request $request)
    {
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
                $nameSurname = trim($row[0] ?? '');
                $email = trim($row[1] ?? '');
                $phone = trim($row[2] ?? '');
                $rolesString = trim($row[3] ?? '');

                // Validasyon
                if (empty($nameSurname) || empty($email) || empty($phone)) {
                    $errors[] = "Satır {$rowNumber}: Ad Soyad, E-posta ve Telefon zorunludur.";
                    continue;
                }

                // Email format kontrolü
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Satır {$rowNumber}: Geçersiz e-posta formatı: {$email}";
                    continue;
                }

                // Telefon format kontrolü (basit)
                if (strlen($phone) < 10) {
                    $errors[] = "Satır {$rowNumber}: Geçersiz telefon numarası: {$phone}";
                    continue;
                }

                // Kullanıcıyı bul veya oluştur
                $user = User::where('email', $email)
                    ->where('company_id', $companyId)
                    ->first();

                if ($user) {
                    // Güncelle
                    $user->name_surname = $nameSurname;
                    $user->phone = $phone;
                    $user->save();
                    $updated++;
                } else {
                    // Yeni kullanıcı oluştur
                    $randomPassword = \Illuminate\Support\Str::random(12);
                    
                    $user = User::create([
                        'company_id' => $companyId,
                        'name_surname' => $nameSurname,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => Hash::make($randomPassword),
                    ]);
                    $imported++;
                }

                // Rolleri işle
                if (!empty($rolesString)) {
                    setPermissionsTeamId($companyId);
                    
                    // Virgülle ayrılmış rolleri al
                    $roleNames = array_map('trim', explode(',', $rolesString));
                    
                    // Mevcut rolleri kaldır
                    $user->roles()->detach();
                    
                    // Rolleri ata
                    foreach ($roleNames as $roleName) {
                        if (empty($roleName)) {
                            continue;
                        }
                        
                        $role = Role::where('company_id', $companyId)
                            ->where('name', $roleName)
                            ->first();
                        
                        if ($role) {
                            $user->assignRole($role);
                        } else {
                            $errors[] = "Satır {$rowNumber}: '{$roleName}' adında bir rol bulunamadı.";
                        }
                    }
                }
            }

            $message = "İçe aktarma tamamlandı. {$imported} yeni personel eklendi, {$updated} personel güncellendi.";
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
}

