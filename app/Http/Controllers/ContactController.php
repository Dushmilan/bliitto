<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private const SUCCESS = 'Thank you! Your message has been sent successfully.';

    public function store(ContactRequest $request): RedirectResponse
    {
        // Honeypot: a bot filled a field no person can see, so accept the
        // request silently without storing anything or sending an email.
        if ($request->filled('website')) {
            return back()->with('status', self::SUCCESS);
        }

        $message = ContactMessage::create(
            $request->safe()->only(['name', 'email', 'message']),
        );

        Mail::to(config('bliitto.contact_recipient'))
            ->queue(new ContactMessageReceived($message));

        return back()->with('status', self::SUCCESS);
    }
}
