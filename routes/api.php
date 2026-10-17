<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public read-only API
|--------------------------------------------------------------------------
|
| Versioned so future changes can ship alongside rather than break the
| current shape. Only published news and active announcements are exposed;
| there is no authentication and no write access.
|
*/

Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{news}', [NewsController::class, 'show']);
    Route::get('/announcements', [AnnouncementController::class, 'index']);
});
