<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    /**
     * Check if onboarding is needed
     */
    public static function needsOnboarding()
    {
        $companyId = Auth::user()->company_id;
        
        $hasBlocks = Block::where('company_id', $companyId)->exists();
        $hasFloors = Floor::where('company_id', $companyId)->exists();
        $hasRooms = Room::where('company_id', $companyId)->exists();
        
        return !$hasBlocks || !$hasFloors || !$hasRooms;
    }

    /**
     * Show welcome/onboarding start page
     */
    public function welcome()
    {
        // If onboarding is not needed, redirect to home
        if (!self::needsOnboarding()) {
            return redirect()->route('admin.index');
        }

        return view('admin.onboarding.welcome');
    }

    /**
     * Show step 1: Add first block
     */
    public function step1()
    {
        $companyId = Auth::user()->company_id;
        
        // Check if block already exists
        if (Block::where('company_id', $companyId)->exists()) {
            return redirect()->route('admin.onboarding.step2');
        }

        return view('admin.onboarding.step1-block');
    }

    /**
     * Store first block
     */
    public function storeBlock(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'block_code' => 'nullable|string|max:50|unique:blocks,block_code',
            'description' => 'nullable|string',
        ]);

        $block = new Block();
        $block->name = $request->input('name');
        $block->block_code = $request->input('block_code');
        $block->description = $request->input('description');
        $block->sort_order = 0;
        $block->is_active = true;
        $block->company_id = Auth::user()->company_id;

        $block->save();

        return redirect()->route('admin.onboarding.step2')->with('success', 'Blok başarıyla oluşturuldu!');
    }

    /**
     * Show step 2: Add first floor
     */
    public function step2()
    {
        $companyId = Auth::user()->company_id;
        
        // Check if block exists
        $block = Block::where('company_id', $companyId)->first();
        if (!$block) {
            return redirect()->route('admin.onboarding.step1')->with('error', 'Önce bir blok oluşturmalısınız.');
        }

        // Check if floor already exists
        if (Floor::where('company_id', $companyId)->exists()) {
            return redirect()->route('admin.onboarding.step3');
        }

        return view('admin.onboarding.step2-floor', compact('block'));
    }

    /**
     * Store first floor
     */
    public function storeFloor(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $block = Block::where('company_id', $companyId)->first();
        
        if (!$block) {
            return redirect()->route('admin.onboarding.step1')->with('error', 'Önce bir blok oluşturmalısınız.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'floor_number' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($block) {
                    $existing = Floor::where('company_id', Auth::user()->company_id)
                        ->where('block_id', $block->id)
                        ->where('floor_number', $value)
                        ->first();
                    if ($existing) {
                        $fail('Bu blokta bu kat numarası zaten mevcut.');
                    }
                },
            ],
            'description' => 'nullable|string',
        ]);

        $floor = new Floor();
        $floor->name = $request->input('name');
        $floor->block_id = $block->id;
        $floor->floor_number = $request->input('floor_number');
        $floor->description = $request->input('description');
        $floor->sort_order = 0;
        $floor->is_active = true;
        $floor->company_id = $companyId;

        $floor->save();

        return redirect()->route('admin.onboarding.step3')->with('success', 'Kat başarıyla oluşturuldu!');
    }

    /**
     * Show step 3: Add first room
     */
    public function step3()
    {
        $companyId = Auth::user()->company_id;
        
        // Check if floor exists
        $floor = Floor::where('company_id', $companyId)->first();
        if (!$floor) {
            return redirect()->route('admin.onboarding.step2')->with('error', 'Önce bir kat oluşturmalısınız.');
        }

        // Check if room already exists
        if (Room::where('company_id', $companyId)->exists()) {
            return redirect()->route('admin.onboarding.complete');
        }

        return view('admin.onboarding.step3-room', compact('floor'));
    }

    /**
     * Store first room
     */
    public function storeRoom(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $floor = Floor::where('company_id', $companyId)->first();
        
        if (!$floor) {
            return redirect()->route('admin.onboarding.step2')->with('error', 'Önce bir kat oluşturmalısınız.');
        }

        $request->validate([
            'room_number' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($floor) {
                    $existing = Room::where('company_id', Auth::user()->company_id)
                        ->where('floor_id', $floor->id)
                        ->where('room_number', $value)
                        ->first();
                    if ($existing) {
                        $fail('Bu katta bu oda numarası zaten mevcut.');
                    }
                },
            ],
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $room = new Room();
        $room->floor_id = $floor->id;
        $room->room_number = $request->input('room_number');
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        $room->sort_order = 0;
        $room->is_active = true;
        $room->company_id = $companyId;

        $room->save();

        return redirect()->route('admin.onboarding.complete')->with('success', 'Oda başarıyla oluşturuldu!');
    }

    /**
     * Show completion page
     */
    public function complete()
    {
        $companyId = Auth::user()->company_id;
        
        $block = Block::where('company_id', $companyId)->first();
        $floor = Floor::where('company_id', $companyId)->first();
        $room = Room::where('company_id', $companyId)->first();

        if (!$block || !$floor || !$room) {
            return redirect()->route('admin.onboarding.welcome');
        }

        return view('admin.onboarding.complete', compact('block', 'floor', 'room'));
    }
}

