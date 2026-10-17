<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');
Route::view('/tisc', 'pages.tisc')->name('tisc');
Route::view('/consultancy', 'pages.consultancy')->name('consultancy');
Route::view('/ip-services', 'pages.ip-services')->name('ip-services');
Route::view('/patent-searches', 'pages.patent-searches')->name('patent-searches');
Route::view('/industry', 'pages.industry')->name('industry');
Route::view('/patented-technologies', 'pages.patented-technologies')->name('patented-technologies');
Route::view('/technology-know-how', 'pages.technology-know-how')->name('technology-know-how');
Route::view('/researchers', 'pages.researchers')->name('researchers');
Route::view('/centers', 'pages.centers')->name('centers');
Route::view('/contact', 'pages.contact')->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
|
| Served from ADMIN_DOMAIN when it is set, and from the /admin prefix
| otherwise so local development needs no DNS changes. Login is the only
| entry point; everything else sits behind the auth middleware.
|
*/

$adminRoutes = function (): void {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('admin.dashboard');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

        Route::resource('news', NewsController::class)
            ->except('show')
            ->names('admin.news');

        Route::resource('announcements', AnnouncementController::class)
            ->except('show')
            ->names('admin.announcements');

        Route::get('messages', [ContactMessageController::class, 'index'])->name('admin.messages.index');
        Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('admin.messages.show');
        Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
    });
};

if ($domain = config('admin.domain')) {
    Route::domain($domain)->group($adminRoutes);
} else {
    Route::prefix('admin')->group($adminRoutes);
}
Route::view('/downloads', 'pages.downloads')->name('downloads');
Route::view('/submission', 'pages.submission')->name('submission');
