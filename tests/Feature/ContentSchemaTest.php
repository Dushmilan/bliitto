<?php

use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\News;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\NewsSeeder;

it('seeds the legacy news content verbatim', function () {
    $this->seed(NewsSeeder::class);

    expect(News::count())->toBe(4);

    $first = News::orderBy('date')->first();

    expect($first->title)->toBe('Innovation & Commercialization Workshop');
    expect($first->date->format('Y-m-d'))->toBe('2025-01-15');
    expect($first->image)->toBe('news-innovation.jpg');
    expect($first->link)->toBe('about.php#vision');
    expect($first->published)->toBeTrue();
});

it('seeds the legacy announcements verbatim', function () {
    $this->seed(AnnouncementSeeder::class);

    expect(Announcement::count())->toBe(3);

    expect(Announcement::orderBy('date')->first()->text)
        ->toBe('Call for invention disclosures — submit your innovative ideas to BLII-TTO for review and IP protection.');
});

it('does not duplicate content when seeded twice', function () {
    $this->seed(NewsSeeder::class);
    $this->seed(NewsSeeder::class);
    $this->seed(AnnouncementSeeder::class);
    $this->seed(AnnouncementSeeder::class);

    expect(News::count())->toBe(4);
    expect(Announcement::count())->toBe(3);
});

it('can run the full database seeder', function () {
    $this->seed();

    expect(News::count())->toBe(4);
    expect(Announcement::count())->toBe(3);
});

it('scopes news to published records', function () {
    News::factory()->count(2)->create();
    News::factory()->unpublished()->create();

    expect(News::count())->toBe(3);
    expect(News::published()->count())->toBe(2);
});

it('scopes announcements to active records', function () {
    Announcement::factory()->count(3)->create();
    Announcement::factory()->inactive()->create();

    expect(Announcement::count())->toBe(4);
    expect(Announcement::active()->count())->toBe(3);
});

it('orders news newest first', function () {
    News::factory()->create(['date' => '2025-01-01']);
    News::factory()->create(['date' => '2025-06-01']);

    expect(News::latestFirst()->first()->date->format('Y-m-d'))->toBe('2025-06-01');
});

it('tracks unread contact messages', function () {
    $unread = ContactMessage::factory()->create();
    ContactMessage::factory()->read()->create();

    expect(ContactMessage::unread()->count())->toBe(1);
    expect($unread->isRead())->toBeFalse();

    $unread->markAsRead();

    expect($unread->fresh()->isRead())->toBeTrue();
    expect(ContactMessage::unread()->count())->toBe(0);
});
