<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
    
        $floors = Floor::query()
            ->where('company_id', Auth::user()->company_id)
            ->with(['user', 'block'])
            ->withCount('rooms')
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('floor_number', 'like', "%{$q}%");
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('floor_number')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();
    
        return view('admin.floor.floors', compact('floors', 'q', 'status'));
    }

    public function create()
    {
        $companyId = Auth::user()->company_id;
        $staff = User::where('company_id', $companyId)->orderBy('name')->get();
        $blocks = Block::where('company_id', $companyId)->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        return view('admin.floor.add-floor', compact('staff', 'blocks'));
    }

    public function edit($id)
    {
        $companyId = Auth::user()->company_id;
        $floor = Floor::where('company_id', $companyId)->findOrFail($id);
        $staff = User::where('company_id', $companyId)->orderBy('name')->get();
        $blocks = Block::where('company_id', $companyId)->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        return view('admin.floor.edit-floor', compact('floor', 'staff', 'blocks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'block_id' => 'required|exists:blocks,id',
            'floor_number' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $existing = Floor::where('company_id', Auth::user()->company_id)
                        ->where('block_id', $request->input('block_id'))
                        ->where('floor_number', $value)
                        ->where('id', '!=', $id)
                        ->first();
                    if ($existing) {
                        $fail('Bu blokta bu kat numarası zaten mevcut.');
                    }
                },
            ],
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $floor = Floor::where('company_id', Auth::user()->company_id)->findOrFail($id);
        $floor->name = $request->input('name');
        $floor->block_id = $request->input('block_id');
        $floor->floor_number = $request->input('floor_number');
        $floor->description = $request->input('description');
        $floor->is_active = $request->input('is_active', 0);
        $floor->sort_order = $request->input('sort_order', 0);
        $floor->user_id = $request->input('user_id');

        $floor->save();

        return redirect()
            ->route('admin.floors.edit', $floor->id)
            ->with('success', 'Kat başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'block_id' => 'required|exists:blocks,id',
            'floor_number' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $existing = Floor::where('company_id', Auth::user()->company_id)
                        ->where('block_id', $request->input('block_id'))
                        ->where('floor_number', $value)
                        ->first();
                    if ($existing) {
                        $fail('Bu blokta bu kat numarası zaten mevcut.');
                    }
                },
            ],
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $floor = new Floor();
        $floor->name = $request->input('name');
        $floor->block_id = $request->input('block_id');
        $floor->floor_number = $request->input('floor_number');
        $floor->description = $request->input('description');
        $floor->sort_order = $request->input('sort_order', 0);
        $floor->is_active = $request->input('is_active');
        $floor->user_id = $request->input('user_id');

        $floor->save();

        return redirect()->route('admin.floors.index')->with('success', 'Kat başarıyla eklendi.');
    }

    public function destroy(Floor $floor)
    {
        if ($floor->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu kata erişim yetkiniz yok.');
        }
        $floor->delete();
    
        return redirect()
            ->back()
            ->with('success', 'Kat başarıyla silindi.');
    }

    public function bulkAssignStaff(Request $request)
    {
        $request->validate([
            'floor_ids' => 'required|array',
            'floor_ids.*' => 'exists:floors,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $floorIds = $request->input('floor_ids');
        $userId = $request->input('user_id');
        $companyId = Auth::user()->company_id;

        Floor::where('company_id', $companyId)->whereIn('id', $floorIds)->update(['user_id' => $userId]);

        $count = count($floorIds);
        $message = $userId 
            ? "{$count} kat için görevli atandı." 
            : "{$count} kat için görevli ataması kaldırıldı.";

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
