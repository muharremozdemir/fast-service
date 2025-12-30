<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Departman listesi
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
    
        $departments = Department::query()
            ->where('company_id', Auth::user()->company_id)
            ->withCount('users')
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%");
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();
    
        return view('admin.department.index', compact('departments', 'q', 'status'));
    }

    /**
     * Yeni departman ekleme formu
     */
    public function create()
    {
        $staff = User::where('company_id', Auth::user()->company_id)->orderBy('name')->get();
        return view('admin.department.create', compact('staff'));
    }

    /**
     * Yeni departman kaydet
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|in:0,1',
            'users' => 'nullable|array',
            'users.*' => [
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if ($user && $user->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen personel sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Departman adı gereklidir.',
            'is_active.required' => 'Durum seçimi gereklidir.',
        ]);

        $department = Department::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => (int) $request->input('is_active'),
            'company_id' => Auth::user()->company_id,
        ]);

        // Personelleri ata
        if ($request->has('users')) {
            $users = User::where('company_id', Auth::user()->company_id)
                ->whereIn('id', $request->input('users'))
                ->get();
            
            $department->users()->attach($users->pluck('id'));
        }

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Departman başarıyla eklendi.');
    }

    /**
     * Departman düzenleme formu
     */
    public function edit($id)
    {
        $department = Department::where('company_id', Auth::user()->company_id)
            ->with('users')
            ->findOrFail($id);
        
        $staff = User::where('company_id', Auth::user()->company_id)->orderBy('name')->get();
        $selectedUsers = $department->users->pluck('id')->toArray();
        
        return view('admin.department.edit', compact('department', 'staff', 'selectedUsers'));
    }

    /**
     * Departman güncelle
     */
    public function update(Request $request, $id)
    {
        $department = Department::where('company_id', Auth::user()->company_id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|in:0,1',
            'users' => 'nullable|array',
            'users.*' => [
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if ($user && $user->company_id !== Auth::user()->company_id) {
                        $fail('Seçilen personel sizin şirketinize ait değil.');
                    }
                },
            ],
        ], [
            'name.required' => 'Departman adı gereklidir.',
            'is_active.required' => 'Durum seçimi gereklidir.',
        ]);

        $department->name = $request->input('name');
        $department->description = $request->input('description');
        $department->is_active = (int) $request->input('is_active');
        $department->save();

        // Personelleri güncelle
        $userIds = $request->input('users', []);
        $users = User::where('company_id', Auth::user()->company_id)
            ->whereIn('id', $userIds)
            ->pluck('id');
        
        $department->users()->sync($users);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Departman başarıyla güncellendi.');
    }

    /**
     * Departman sil
     */
    public function destroy($id)
    {
        $department = Department::where('company_id', Auth::user()->company_id)->findOrFail($id);
        
        // Pivot tablodaki kayıtları otomatik silinecek (cascade)
        $department->delete();
    
        return redirect()
            ->back()
            ->with('success', 'Departman başarıyla silindi.');
    }
}
