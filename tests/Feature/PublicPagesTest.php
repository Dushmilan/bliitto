<?php

use App\Models\Announcement;
use App\Models\News;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\NewsSeeder;

it('renders every public page', function (string $route) {
    $this->get(route($route))->assertOk();
})->with([
    'home',
    'about',
    'services',
    'tisc',
    'consultancy',
    'ip-services',
    'patent-searches',
    'industry',
    'patented-technologies',
    'technology-know-how',
    'researchers',
    'centers',
    'contact',
    'downloads',
    'submission',
]);

it('shows the seeded news and announcements on the home page', function () {
    $this->seed(NewsSeeder::class);
    $this->seed(AnnouncementSeeder::class);

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('Innovation &amp; Commercialization Workshop', false);
    $response->assertSee('Research-Industry Meetup');
    $response->assertSee('Call for invention disclosures', false);
    $response->assertSee('May 01, 2025');
});

it('links news items to their translated routes', function () {
    $this->seed(NewsSeeder::class);

    $response = $this->get(route('home'));

    // 'about.php#vision' must resolve to the about route plus the anchor.
    $response->assertSee(route('about').'#vision', false);
    $response->assertSee(route('centers'), false);
});

it('hides unpublished news and inactive announcements', function () {
    News::factory()->create(['title' => 'Published Story']);
    News::factory()->unpublished()->create(['title' => 'Hidden Story']);
    Announcement::factory()->create(['text' => 'Visible announcement']);
    Announcement::factory()->inactive()->create(['text' => 'Hidden announcement']);

    $response = $this->get(route('home'));

    $response->assertSee('Published Story');
    $response->assertDontSee('Hidden Story');
    $response->assertSee('Visible announcement');
    $response->assertDontSee('Hidden announcement');
});

it('limits the home page to four published news items', function () {
    News::factory()->count(6)->create();
    News::factory()->unpublished()->create();

    $response = $this->get(route('home'));

    expect(substr_count($response->getContent(), 'class="news-title"'))->toBe(4);
});

it('renders the contact form with a honeypot and CSRF token', function () {
    $response = $this->get(route('contact'));

    $response->assertOk();
    $response->assertSee('name="website"', false);
    $response->assertSee('name="_token"', false);
    $response->assertSee('action="'.url('/contact').'"', false);
});

it('serves the static assets copied into public', function (string $asset) {
    expect(file_exists(public_path($asset)))->toBeTrue();
})->with([
    'styles.css',
    'script.js',
    'hero.jpg',
    'about.jpg',
    'uop-logo-transparent.png',
    'news-innovation.jpg',
]);

it('renders a branded 404 page', function () {
    $this->get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('Page Not Found');
});
