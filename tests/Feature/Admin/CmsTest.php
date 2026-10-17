<?php

use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

// Upload fixtures use create() with an image MIME type rather than image(),
// because image() needs the GD extension, which is not always available.

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('blocks guests from every cms screen', function () {
    auth()->logout();

    foreach ([
        route('admin.dashboard'),
        route('admin.news.index'),
        route('admin.news.create'),
        route('admin.announcements.index'),
        route('admin.announcements.create'),
        route('admin.messages.index'),
    ] as $url) {
        $this->get($url)->assertRedirect(route('admin.login'));
    }
});

it('shows the dashboard counts', function () {
    News::factory()->count(2)->create();
    News::factory()->unpublished()->create();
    Announcement::factory()->count(3)->create();
    Announcement::factory()->inactive()->create();
    ContactMessage::factory()->count(4)->create();
    ContactMessage::factory()->read()->count(2)->create();

    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertViewHas('publishedNews', 2)
        ->assertViewHas('activeAnnouncements', 3)
        ->assertViewHas('unreadMessages', 4);
});

it('lists news items for management', function () {
    News::factory()->create(['title' => 'Manageable Story']);

    $this->get(route('admin.news.index'))
        ->assertOk()
        ->assertSee('Manageable Story');
});

it('creates a news item', function () {
    $this->post(route('admin.news.store'), [
        'title' => 'Brand New Story',
        'date' => '2025-07-01',
        'description' => 'Something notable happened.',
        'link' => 'about.php#vision',
        'published' => '1',
    ])->assertRedirect(route('admin.news.index'))->assertSessionHas('status');

    $news = News::where('title', 'Brand New Story')->first();

    expect($news)->not->toBeNull()
        ->and($news->published)->toBeTrue()
        ->and($news->date->format('Y-m-d'))->toBe('2025-07-01')
        ->and($news->link)->toBe('about.php#vision');
});

it('keeps a news item as a draft when the toggle is absent', function () {
    $this->post(route('admin.news.store'), [
        'title' => 'Draft Story',
        'date' => '2025-07-01',
    ])->assertRedirect();

    expect(News::where('title', 'Draft Story')->first()->published)->toBeFalse();
});

it('validates news input', function () {
    $this->post(route('admin.news.store'), ['title' => '', 'date' => 'not-a-date'])
        ->assertSessionHasErrors(['title', 'date']);

    expect(News::count())->toBe(0);
});

it('updates a news item', function () {
    $news = News::factory()->create(['title' => 'Old Title', 'published' => false]);

    $this->put(route('admin.news.update', $news), [
        'title' => 'New Title',
        'date' => '2025-08-01',
        'published' => '1',
    ])->assertRedirect(route('admin.news.index'));

    $news->refresh();

    expect($news->title)->toBe('New Title')
        ->and($news->published)->toBeTrue()
        ->and($news->date->format('Y-m-d'))->toBe('2025-08-01');
});

it('stores an uploaded image', function () {
    Storage::fake('public');

    $this->post(route('admin.news.store'), [
        'title' => 'With Image',
        'date' => '2025-07-01',
        'image' => UploadedFile::fake()->create('photo.jpg', 10, 'image/jpeg'),
        'published' => '1',
    ])->assertRedirect();

    $news = News::where('title', 'With Image')->first();

    expect($news->image)->toStartWith('news/');
    Storage::disk('public')->assertExists($news->image);
});

it('rejects a non-image upload', function () {
    Storage::fake('public');

    $this->post(route('admin.news.store'), [
        'title' => 'Bad Upload',
        'date' => '2025-07-01',
        'image' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
    ])->assertSessionHasErrors('image');

    expect(News::where('title', 'Bad Upload')->exists())->toBeFalse();
});

it('replaces the old image and deletes the file on update', function () {
    Storage::fake('public');

    $news = News::factory()->create([
        'image' => UploadedFile::fake()->create('old.jpg', 10, 'image/jpeg')->store('news', 'public'),
    ]);
    $old = $news->image;

    $this->put(route('admin.news.update', $news), [
        'title' => $news->title,
        'date' => '2025-07-02',
        'image' => UploadedFile::fake()->create('new.jpg', 10, 'image/jpeg'),
        'published' => '1',
    ])->assertRedirect();

    $news->refresh();

    expect($news->image)->not->toBe($old);
    Storage::disk('public')->assertMissing($old);
    Storage::disk('public')->assertExists($news->image);
});

it('deletes a news item together with its uploaded image', function () {
    Storage::fake('public');

    $news = News::factory()->create([
        'image' => UploadedFile::fake()->create('remove-me.jpg', 10, 'image/jpeg')->store('news', 'public'),
    ]);
    $path = $news->image;

    $this->delete(route('admin.news.destroy', $news))->assertRedirect(route('admin.news.index'));

    expect(News::find($news->id))->toBeNull();
    Storage::disk('public')->assertMissing($path);
});

it('never deletes the bundled legacy image of a news item', function () {
    $news = News::factory()->create(['image' => 'news-innovation.jpg']);

    $this->delete(route('admin.news.destroy', $news))->assertRedirect();

    expect(file_exists(public_path('news-innovation.jpg')))->toBeTrue();
});

it('creates an announcement', function () {
    $this->post(route('admin.announcements.store'), [
        'date' => '2025-09-01',
        'text' => 'A brand new notice.',
        'active' => '1',
    ])->assertRedirect(route('admin.announcements.index'))->assertSessionHas('status');

    expect(Announcement::where('text', 'A brand new notice.')->exists())->toBeTrue();
});

it('validates announcement input', function () {
    $this->post(route('admin.announcements.store'), ['date' => '', 'text' => ''])
        ->assertSessionHasErrors(['date', 'text']);

    expect(Announcement::count())->toBe(0);
});

it('updates an announcement and can hide it', function () {
    $announcement = Announcement::factory()->create(['text' => 'Before', 'active' => true]);

    $this->put(route('admin.announcements.update', $announcement), [
        'date' => $announcement->date->format('Y-m-d'),
        'text' => 'After',
    ])->assertRedirect(route('admin.announcements.index'));

    $updated = $announcement->fresh();

    expect($updated->text)->toBe('After')
        ->and($updated->active)->toBeFalse();
});

it('deletes an announcement', function () {
    $announcement = Announcement::factory()->create();

    $this->delete(route('admin.announcements.destroy', $announcement))
        ->assertRedirect(route('admin.announcements.index'));

    expect(Announcement::find($announcement->id))->toBeNull();
});

it('lists unread messages before read ones', function () {
    $read = ContactMessage::factory()->read()->create(['name' => 'Read Sender']);
    $unread = ContactMessage::factory()->create(['name' => 'Unread Sender']);

    $response = $this->get(route('admin.messages.index'));

    $response->assertOk()
        ->assertSee('Unread Sender')
        ->assertSee('Read Sender');

    expect($response->viewData('messages')->pluck('id')->all())
        ->toBe([$unread->id, $read->id]);
});

it('marks a message as read when it is opened', function () {
    $message = ContactMessage::factory()->create(['name' => 'Nimal Perera']);

    expect($message->isRead())->toBeFalse();

    $this->get(route('admin.messages.show', $message))
        ->assertOk()
        ->assertSee('Nimal Perera');

    expect($message->fresh()->isRead())->toBeTrue();
});

it('deletes a message', function () {
    $message = ContactMessage::factory()->create();

    $this->delete(route('admin.messages.destroy', $message))
        ->assertRedirect(route('admin.messages.index'));

    expect(ContactMessage::find($message->id))->toBeNull();
});
