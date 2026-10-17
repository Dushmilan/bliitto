<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', [
            'newsItems' => News::query()->latestFirst()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.create', [
            'news' => new News(['published' => true, 'date' => now()]),
        ]);
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        News::create($this->attributes($request));

        return redirect()->route('admin.news.index')->with('status', 'News item created.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', ['news' => $news]);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        $news->update($this->attributes($request, $news));

        return redirect()->route('admin.news.index')->with('status', 'News item updated.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $this->deleteUpload($news->image);

        $news->delete();

        return redirect()->route('admin.news.index')->with('status', 'News item deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function attributes(NewsRequest $request, ?News $news = null): array
    {
        $data = $request->safe()->only(['title', 'date', 'description', 'link']);
        $data['published'] = $request->boolean('published');

        if ($request->hasFile('image')) {
            if ($news !== null) {
                $this->deleteUpload($news->image);
            }

            $data['image'] = $request->file('image')->store('news', 'public');
        }

        return $data;
    }

    /**
     * Remove an uploaded image. Bundled legacy assets live in public/ and are
     * not on the public disk, so they are never deleted.
     */
    private function deleteUpload(?string $path): void
    {
        if ($path !== null && str_contains($path, '/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
