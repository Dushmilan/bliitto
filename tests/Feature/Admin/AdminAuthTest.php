<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('redirects guests from the admin dashboard to the login screen', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
});

it('shows the login screen to guests', function () {
    $this->get(route('admin.login'))->assertOk()->assertSee('Sign in');
});

it('signs an administrator in with valid credentials', function () {
    $user = User::factory()->create(['password' => Hash::make('secret-password')]);

    $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'secret-password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($user);

    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee($user->email);
});

it('rejects invalid credentials', function () {
    $user = User::factory()->create(['password' => Hash::make('secret-password')]);

    $this->from(route('admin.login'))->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ])->assertRedirect(route('admin.login'))->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('throttles repeated failed logins', function () {
    $user = User::factory()->create(['password' => Hash::make('secret-password')]);

    foreach (range(1, 5) as $ignored) {
        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
    }

    // Sixth attempt is locked out, and even the correct password is refused.
    $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'secret-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('logs an administrator out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.logout'))
        ->assertRedirect(route('admin.login'));

    $this->assertGuest();
});

it('redirects signed-in users away from the login screen', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.login'))
        ->assertRedirect(route('admin.dashboard'));
});

it('exposes no self-registration route', function () {
    $this->get('/register')->assertNotFound();
    $this->get('/admin/register')->assertNotFound();
});

it('leaves the public site open to guests', function () {
    $this->get(route('home'))->assertOk();
    $this->get(route('contact'))->assertOk();
});

it('serves the admin from the /admin prefix when no domain is configured', function () {
    expect(config('admin.domain'))->toBeEmpty();
    expect(route('admin.login'))->toContain('/admin/login');
});

it('creates an administrator from the console', function () {
    $this->artisan('make:admin', [
        '--name' => 'Site Admin',
        '--email' => 'admin@example.com',
        '--password' => 'a-long-password',
    ])->assertSuccessful();

    $user = User::where('email', 'admin@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->name)->toBe('Site Admin')
        ->and(Hash::check('a-long-password', $user->password))->toBeTrue();
});

it('updates the password when run again for an existing administrator', function () {
    $this->artisan('make:admin', [
        '--name' => 'Site Admin',
        '--email' => 'admin@example.com',
        '--password' => 'first-password',
    ])->assertSuccessful();

    $this->artisan('make:admin', [
        '--name' => 'Site Admin',
        '--email' => 'admin@example.com',
        '--password' => 'second-password',
    ])->assertSuccessful();

    expect(User::where('email', 'admin@example.com')->count())->toBe(1)
        ->and(Hash::check('second-password', User::where('email', 'admin@example.com')->value('password')))->toBeTrue();
});

it('refuses a short password from the console', function () {
    $this->artisan('make:admin', [
        '--name' => 'Site Admin',
        '--email' => 'admin@example.com',
        '--password' => 'short',
    ])->assertFailed();

    expect(User::count())->toBe(0);
});

it('refuses an invalid email from the console', function () {
    $this->artisan('make:admin', [
        '--name' => 'Site Admin',
        '--email' => 'not-an-email',
        '--password' => 'a-long-password',
    ])->assertFailed();

    expect(User::count())->toBe(0);
});
