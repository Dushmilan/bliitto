<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return NewsResource::collection(
            News::query()->published()->latestFirst()->paginate(15),
        );
    }

    public function show(int $news): NewsResource
    {
        return new NewsResource(
            News::query()->published()->findOrFail($news),
        );
    }
}
