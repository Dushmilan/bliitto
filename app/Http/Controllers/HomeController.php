<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\News;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'news' => News::query()->published()->latestFirst()->limit(4)->get(),
            'announcements' => Announcement::query()->active()->latestFirst()->get(),
        ]);
    }
}
