<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        return view('admin.announcements.index', [
            'announcements' => Announcement::query()->latestFirst()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.announcements.create', [
            'announcement' => new Announcement(['active' => true, 'date' => now()]),
        ]);
    }

    public function store(AnnouncementRequest $request): RedirectResponse
    {
        Announcement::create($this->attributes($request));

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement created.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('admin.announcements.edit', ['announcement' => $announcement]);
    }

    public function update(AnnouncementRequest $request, Announcement $announcement): RedirectResponse
    {
        $announcement->update($this->attributes($request));

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function attributes(AnnouncementRequest $request): array
    {
        $data = $request->safe()->only(['date', 'text']);
        $data['active'] = $request->boolean('active');

        return $data;
    }
}
