<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\User;
use App\Models\Block;
use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
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

        $floors = Floor::query()
            ->where('company_id', Auth::user()->company_id)
            ->with(['block', 'users'])
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
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $companyId = Auth::user()->company_id;
        $blocks = Block::where('company_id', $companyId)->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        $categories = Category::where('company_id', $companyId)->where('is_active', true)->orderBy('name')->get();
        return view('admin.floor.add-floor', compact('blocks', 'categories'));
    }

    public function edit($id)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $companyId = Auth::user()->company_id;
        $floor = Floor::where('company_id', $companyId)->with(['users'])->findOrFail($id);
        $blocks = Block::where('company_id', $companyId)->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        $categories = Category::where('company_id', $companyId)->where('is_active', true)->orderBy('name')->get();

        // Kata atanmış kullanıcıları kategori bazında grupla
        $assignedCategoryUsers = [];
        foreach ($floor->users as $user) {
            $categoryId = $user->pivot->category_id;
            if ($categoryId) {
                if (!isset($assignedCategoryUsers[$categoryId])) {
                    $assignedCategoryUsers[$categoryId] = [];
                }
                $assignedCategoryUsers[$categoryId][] = $user->id;
            }
        }

        return view('admin.floor.edit-floor', compact('floor', 'blocks', 'categories', 'assignedCategoryUsers'));
    }

    public function update(Request $request, $id)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
            'category_users' => 'nullable|array',
            'category_users.*.category_id' => 'required|exists:categories,id',
            'category_users.*.user_ids' => 'nullable|array',
            'category_users.*.user_ids.*' => 'exists:users,id',
        ]);

        $floor = Floor::where('company_id', Auth::user()->company_id)->findOrFail($id);
        $floor->name = $request->input('name');
        $floor->block_id = $request->input('block_id');
        $floor->floor_number = $request->input('floor_number');
        $floor->description = $request->input('description');
        $floor->is_active = $request->input('is_active', 0);
        $floor->sort_order = $request->input('sort_order', 0);

        $floor->save();

        // Tüm kategori bazlı kullanıcı atamalarını kaldır
        $floor->users()->detach();

        // Yeni kategori bazlı kullanıcı atamalarını yap
        $categoryUsers = $request->input('category_users', []);
        foreach ($categoryUsers as $categoryUser) {
            $categoryId = $categoryUser['category_id'] ?? null;
            $userIds = $categoryUser['user_ids'] ?? [];

            if ($categoryId && !empty($userIds)) {
                foreach ($userIds as $userId) {
                    $floor->users()->attach($userId, ['category_id' => $categoryId]);
                }
            }
        }

        return redirect()
            ->route('admin.floors.edit', $floor->id)
            ->with('success', 'Kat başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

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
            'category_users' => 'nullable|array',
            'category_users.*.category_id' => 'required|exists:categories,id',
            'category_users.*.user_ids' => 'nullable|array',
            'category_users.*.user_ids.*' => 'exists:users,id',
        ]);

        $floor = new Floor();
        $floor->name = $request->input('name');
        $floor->block_id = $request->input('block_id');
        $floor->floor_number = $request->input('floor_number');
        $floor->description = $request->input('description');
        $floor->sort_order = $request->input('sort_order', 0);
        $floor->is_active = $request->input('is_active');
        $floor->company_id = Auth::user()->company_id;

        $floor->save();

        // Kategori bazlı kullanıcı atamalarını yap
        $categoryUsers = $request->input('category_users', []);
        foreach ($categoryUsers as $categoryUser) {
            $categoryId = $categoryUser['category_id'] ?? null;
            $userIds = $categoryUser['user_ids'] ?? [];

            if ($categoryId && !empty($userIds)) {
                foreach ($userIds as $userId) {
                    $floor->users()->attach($userId, ['category_id' => $categoryId]);
                }
            }
        }

        return redirect()->route('admin.floors.index')->with('success', 'Kat başarıyla eklendi.');
    }

    public function destroy(Floor $floor)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        if ($floor->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu kata erişim yetkiniz yok.');
        }
        $floor->delete();

        return redirect()
            ->back()
            ->with('success', 'Kat başarıyla silindi.');
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
}
