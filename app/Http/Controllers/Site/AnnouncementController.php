<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
    public function index()
    {
        $roomNumber = Session::get('room_number');
        
        if (!$roomNumber) {
            return response()->json(['announcements' => []]);
        }

        // Get company from room
        $room = Room::where('room_number', $roomNumber)->first();
        if (!$room || !$room->company_id) {
            return response()->json(['announcements' => []]);
        }

        // Get active announcements for this company
        $announcements = Announcement::where('company_id', $room->company_id)
            ->where('is_active', 1)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($announcement) {
                return [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'content' => $announcement->content,
                    'published_at' => $announcement->published_at->format('d.m.Y H:i'),
                    'published_at_timestamp' => $announcement->published_at->timestamp,
                ];
            });

        return response()->json(['announcements' => $announcements]);
    }
}

