<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\News;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'publishedNews' => News::query()->published()->count(),
            'activeAnnouncements' => Announcement::query()->active()->count(),
            'unreadMessages' => ContactMessage::query()->unread()->count(),
        ]);
    }
}
