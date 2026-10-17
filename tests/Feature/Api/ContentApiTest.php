<?php

use App\Models\Announcement;
use App\Models\News;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\NewsSeeder;

it('lists published news only, newest first', function () {
    News::factory()->create(['title' => 'Newer', 'date' => '2025-06-01']);
    News::factory()->create(['title' => 'Older', 'date' => '2025-01-01']);
    News::factory()->unpublished()->create(['title' => 'Draft Story']);

    $response = $this->getJson('/api/v1/news');

    $response->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('data.0.title', 'Newer')
        ->assertJsonPath('data.1.title', 'Older');

    expect(collect($response->json('data'))->pluck('title'))->not->toContain('Draft Story');
});

it('returns the documented shape for a news item', function () {
    $news = News::factory()->create([
        'title' => 'Innovation Workshop',
        'date' => '2025-01-15',
        'image' => 'news-innovation.jpg',
        'description' => 'Transforming research into innovations.',
        'link' => 'about.php#vision',
    ]);

    $response = $this->getJson("/api/v1/news/{$news->id}");

    $response->assertOk()->assertJsonStructure([
        'data' => ['id', 'title', 'date', 'description', 'image', 'link', 'updated_at'],
    ]);

    $response->assertJsonPath('data.title', 'Innovation Workshop');
    $response->assertJsonPath('data.date', '2025-01-15');
    $response->assertJsonPath('data.image', asset('news-innovation.jpg'));
    $response->assertJsonPath('data.link', route('about').'#vision');
});

it('returns null image when the news item has none', function () {
    $news = News::factory()->create(['image' => null]);

    $this->getJson("/api/v1/news/{$news->id}")
        ->assertOk()
        ->assertJsonPath('data.image', null);
});

it('returns 404 for an unpublished news item', function () {
    $news = News::factory()->unpublished()->create();

    $this->getJson("/api/v1/news/{$news->id}")
        ->assertNotFound()
        ->assertJsonPath('message', 'Not Found');
});

it('returns 404 for a missing news item', function () {
    $this->getJson('/api/v1/news/999')
        ->assertNotFound()
        ->assertJsonPath('message', 'Not Found');
});

it('paginates the news list', function () {
    News::factory()->count(20)->create();

    $response = $this->getJson('/api/v1/news');

    $response->assertOk()
        ->assertJsonCount(15, 'data')
        ->assertJsonPath('meta.total', 20)
        ->assertJsonPath('meta.per_page', 15);
});

it('lists active announcements only', function () {
    Announcement::factory()->create(['text' => 'Active notice', 'date' => '2025-05-01']);
    Announcement::factory()->inactive()->create(['text' => 'Retired notice']);

    $response = $this->getJson('/api/v1/announcements');

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.text', 'Active notice')
        ->assertJsonStructure(['data' => [['id', 'date', 'text', 'updated_at']]]);
});

it('exposes the seeded content', function () {
    $this->seed(NewsSeeder::class);
    $this->seed(AnnouncementSeeder::class);

    $this->getJson('/api/v1/news')->assertOk()->assertJsonCount(4, 'data');
    $this->getJson('/api/v1/announcements')->assertOk()->assertJsonCount(3, 'data');
});

it('serves the api without authentication', function () {
    $this->getJson('/api/v1/news')->assertOk();
});

it('returns json for an unknown api route', function () {
    $this->getJson('/api/v1/does-not-exist')
        ->assertNotFound()
        ->assertJsonPath('message', 'Not Found');
});

it('rate limits excessive requests', function () {
    foreach (range(1, 60) as $ignored) {
        $this->getJson('/api/v1/news')->assertOk();
    }

    $this->getJson('/api/v1/news')->assertStatus(429);
});
