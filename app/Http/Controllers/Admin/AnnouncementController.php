<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');

        $announcements = Announcement::where('company_id', Auth::user()->company_id)
            ->when($q, function ($query, $q) {
                $query->where('title', 'like', "%{$q}%");
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.announcement.index', compact('announcements', 'q', 'status'));
    }

    public function create()
    {
        return view('admin.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'required|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        $announcement = new Announcement();
        $announcement->company_id = Auth::user()->company_id;
        $announcement->title = $request->input('title');
        $announcement->content = $request->input('content');
        $announcement->is_active = (int) $request->input('is_active', 1);
        $announcement->published_at = $request->input('published_at') ? date('Y-m-d H:i:s', strtotime($request->input('published_at'))) : now();

        $announcement->save();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Duyuru başarıyla eklendi.');
    }

    public function edit($id)
    {
        $announcement = Announcement::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'required|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        $announcement = Announcement::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $announcement->title = $request->input('title');
        $announcement->content = $request->input('content');
        $announcement->is_active = (int) $request->input('is_active', 1);
        
        if ($request->input('published_at')) {
            $announcement->published_at = date('Y-m-d H:i:s', strtotime($request->input('published_at')));
        }

        $announcement->save();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Duyuru başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $announcement->delete();

        return redirect()
            ->back()
            ->with('success', 'Duyuru başarıyla silindi.');
    }

    public function unpublish($id)
    {
        $announcement = Announcement::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $announcement->is_active = 0;
        $announcement->save();

        return redirect()
            ->back()
            ->with('success', 'Duyuru yayından kaldırıldı.');
    }
}

