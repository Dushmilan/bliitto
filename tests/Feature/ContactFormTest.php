<?php

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();
});

function contact_payload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Amani Kahandawa',
        'email' => 'amani@example.com',
        'message' => 'We would like to discuss licensing one of your patents.',
    ], $overrides);
}

it('stores a message, notifies staff and flashes success', function () {
    $response = $this->from(route('contact'))->post(route('contact.store'), contact_payload());

    $response->assertRedirect(route('contact'));
    $response->assertSessionHas('status');

    expect(ContactMessage::count())->toBe(1);

    $message = ContactMessage::first();

    expect($message->name)->toBe('Amani Kahandawa');
    expect($message->email)->toBe('amani@example.com');
    expect($message->isRead())->toBeFalse();

    Mail::assertQueued(ContactMessageReceived::class);
});

it('notifies the configured recipient and replies to the submitter', function () {
    $this->post(route('contact.store'), contact_payload());

    Mail::assertQueued(ContactMessageReceived::class, function (ContactMessageReceived $mail) {
        return $mail->hasTo(config('bliitto.contact_recipient'))
            && $mail->hasReplyTo('amani@example.com');
    });
});

it('renders the notification with the message details', function () {
    $message = ContactMessage::factory()->create([
        'name' => 'Nimal Perera',
        'message' => 'Requesting a patent prior-art search.',
    ]);

    (new ContactMessageReceived($message))
        ->assertSeeInHtml('Nimal Perera')
        ->assertSeeInHtml('Requesting a patent prior-art search.');
});

it('rejects an invalid submission and keeps the old input', function () {
    $response = $this->from(route('contact'))->post(route('contact.store'), [
        'name' => '',
        'email' => 'not-an-email',
        'message' => 'too short',
    ]);

    $response->assertRedirect(route('contact'));
    $response->assertSessionHasErrors(['name', 'email', 'message']);
    $response->assertSessionHasInput('email', 'not-an-email');

    expect(ContactMessage::count())->toBe(0);
    Mail::assertNothingQueued();
});

it('silently drops submissions that fill the honeypot', function () {
    $response = $this->from(route('contact'))->post(route('contact.store'), contact_payload([
        'website' => 'http://spam.example',
    ]));

    $response->assertRedirect(route('contact'));
    $response->assertSessionHas('status');

    expect(ContactMessage::count())->toBe(0);
    Mail::assertNothingQueued();
});

it('rate limits repeated submissions', function () {
    foreach (range(1, 6) as $ignored) {
        $this->post(route('contact.store'), contact_payload())->assertRedirect();
    }

    $this->post(route('contact.store'), contact_payload())->assertStatus(429);

    expect(ContactMessage::count())->toBe(6);
});

it('submits through a plain form post with no JavaScript', function () {
    $html = $this->get(route('contact'))->getContent();

    expect($html)->toContain('method="POST"');
    expect($html)->toContain(route('contact.store'));

    $this->post(route('contact.store'), contact_payload())->assertRedirect();

    expect(ContactMessage::count())->toBe(1);
});
