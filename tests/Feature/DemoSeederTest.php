<?php

use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\News;
use App\Models\User;
use Database\Seeders\DemoSeeder;
use Illuminate\Support\Facades\Hash;

it('seeds the demo administrator and sample content without duplicates', function () {
    $this->seed(DemoSeeder::class);

    $admin = User::where('email', config('bliitto.demo_admin_email'))->first();

    expect($admin)->not->toBeNull()
        ->and($admin->name)->toBe(config('bliitto.demo_admin_name'))
        ->and(Hash::check(config('bliitto.demo_admin_password'), $admin->password))->toBeTrue()
        ->and(ContactMessage::count())->toBe(4)
        ->and(News::count())->toBe(3)
        ->and(Announcement::count())->toBe(2);

    $this->seed(DemoSeeder::class);

    expect(User::where('email', config('bliitto.demo_admin_email'))->count())->toBe(1)
        ->and(ContactMessage::count())->toBe(4)
        ->and(News::count())->toBe(3)
        ->and(Announcement::count())->toBe(2);
});

it('skips the demo administrator in production when credentials are hidden', function () {
    app()->detectEnvironment(fn (): string => 'production');
    config(['bliitto.show_demo_credentials' => false]);

    $this->artisan('db:seed', [
        '--class' => DemoSeeder::class,
        '--force' => true,
    ])->assertSuccessful();

    expect(User::count())->toBe(0)
        ->and(ContactMessage::count())->toBe(4);
});
