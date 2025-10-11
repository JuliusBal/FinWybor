<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterUnsubscribed;
use App\Mail\NewsletterUnsubscribeLink;
use App\Mail\NewsletterWelcome;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot
        if ($request->filled('website')) {
            return $request->wantsJson()
                ? response()->json(['message' => 'OK'], 200)
                : back();
        }

        $data = $request->validate([
            'email' => 'required|email:rfc',
        ]);

        $sub = Subscriber::firstOrNew(['email' => $data['email']]);

        $wasNew       = ! $sub->exists;
        $wasInactive  = $sub->exists && ! $sub->isActive();

        if ($wasInactive) {
            $sub->status = 'subscribed';
            $sub->unsubscribed_at = null;
        }

        $sub->fill([
            'ip'              => $request->ip(),
            'user_agent'      => substr((string) $request->userAgent(), 0, 512),
            'source'          => $request->headers->get('referer') ?: 'site',
        ])->save();

        if ($wasNew || $wasInactive) {
            try {
                Mail::to($sub->email)->send(new NewsletterWelcome($sub));
            } catch (\Throwable $e) {
                \Log::warning('NewsletterWelcome failed', [
                    'email' => $sub->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $request->wantsJson()
            ? response()->json(['message' => 'Dziękujemy! Sprawdź swoją skrzynkę.'])
            : back()->with('newsletter_ok', 'Dziękujemy! Sprawdź swoją skrzynkę.');
    }

    public function unsubscribe(string $token)
    {
        $sub = Subscriber::where('token', $token)->firstOrFail();

        if (is_null($sub->unsubscribed_at)) {
            $sub->update([
                'status'          => 'unsubscribed',
                'unsubscribed_at' => now(),
            ]);

            try {
                Mail::to($sub->email)->send(new NewsletterUnsubscribed($sub));
            } catch (\Throwable $e) {
                \Log::warning('NewsletterUnsubscribed failed', ['email' => $sub->email, 'error' => $e->getMessage()]);
            }
        }

        return view('newsletter.unsubscribed', ['email' => $sub->email]);
    }

    public function center()
    {
        return view('newsletter.center');
    }

    public function requestUnsubscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email:rfc,dns'],
        ]);

        $subscriber = Subscriber::where('email', $data['email'])->first();

        if ($subscriber) {
            if (!$subscriber->token) {
                $subscriber->token = Str::random(32);
                $subscriber->save();
            }
            Mail::to($subscriber->email)->send(new NewsletterUnsubscribeLink($subscriber));
        }

        return back()->with('status', 'Jeśli adres istnieje w naszej bazie, wyślemy link do wypisania.');
    }
}
