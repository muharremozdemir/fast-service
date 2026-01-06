<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
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

        $blocks = Block::query()
            ->where('company_id', Auth::user()->company_id)
            ->withCount('floors')
            ->when($q, function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('block_code', 'like', "%{$q}%");
                });
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.block.blocks', compact('blocks', 'q', 'status'));
    }

    public function create()
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        return view('admin.block.add-block');
    }

    public function edit($id)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $block = Block::where('company_id', Auth::user()->company_id)->findOrFail($id);
        return view('admin.block.edit-block', compact('block'));
    }

    public function update(Request $request, $id)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'block_code' => 'nullable|string|max:50|unique:blocks,block_code,' . $id,
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ]);

        $block = Block::where('company_id', Auth::user()->company_id)->findOrFail($id);
        $block->name = $request->input('name');
        $block->block_code = $request->input('block_code');
        $block->description = $request->input('description');
        $block->is_active = $request->input('is_active', 0);
        $block->sort_order = $request->input('sort_order', 0);

        $block->save();

        return redirect()
            ->route('admin.blocks.index')
            ->with('success', 'Blok başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'block_code' => 'nullable|string|max:50|unique:blocks,block_code',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean',
        ]);

        $block = new Block();
        $block->name = $request->input('name');
        $block->block_code = $request->input('block_code');
        $block->description = $request->input('description');
        $block->sort_order = $request->input('sort_order', 0);
        $block->is_active = $request->input('is_active');
        $block->company_id = Auth::user()->company_id;

        $block->save();

        return redirect()->route('admin.blocks.index')->with('success', 'Blok başarıyla eklendi.');
    }

    public function destroy(Block $block)
    {
        $onboardingCheck = $this->checkOnboarding();
        if ($onboardingCheck) {
            return $onboardingCheck;
        }

        if ($block->company_id !== Auth::user()->company_id) {
            abort(403, 'Bu bloka erişim yetkiniz yok.');
        }
        $block->delete();

        return redirect()
            ->back()
            ->with('success', 'Blok başarıyla silindi.');
    }
}
