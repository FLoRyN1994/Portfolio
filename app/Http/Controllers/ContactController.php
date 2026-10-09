<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Notifications\ContactNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Honeypot — bots fill the hidden `website` field
        if ($request->filled('website')) {
            return back()->with('success', 'Thanks! I\'ll get back to you soon.');
        }

        // reCAPTCHA v3 verification
        if ($secretKey = config('portfolio.recaptcha_secret_key')) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secretKey,
                'response' => $request->input('recaptcha_token', ''),
                'remoteip' => $request->ip(),
            ]);

            $score = $response->json('score', 0);
            if (! $response->json('success') || $score < 0.5) {
                return back()->withErrors(['message' => 'Spam check failed. Please try again.'])->withInput();
            }
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $submission = ContactSubmission::create($validated);

        if ($email = config('portfolio.contact_email')) {
            Notification::route('mail', $email)
                ->notify(new ContactNotification($submission));
        }

        return back()->with('success', 'Thanks! I\'ll get back to you soon.');
    }
}
