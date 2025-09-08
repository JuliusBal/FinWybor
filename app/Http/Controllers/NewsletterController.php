<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterUnsubscribeLink;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return $request->wantsJson()
                ? response()->json(['message' => 'OK'], 200)
                : back();
        }

        $data = $request->validate([
            'email' => 'required|email:rfc',
        ]);

        $sub = Subscriber::firstOrNew(['email' => $data['email']]);

        $sub->fill([
            'status'       => 'subscribed',
            'ip'           => $request->ip(),
            'user_agent'   => substr((string) $request->userAgent(), 0, 512),
            'source'       => $request->headers->get('referer') ?: 'site',
            'unsubscribed_at' => null,
        ]);

        $sub->save();

        // TODO: optionally send a welcome/confirm email here

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Dziękujemy! Sprawdź swoją skrzynkę.']);
        }

        return back()->with('newsletter_ok', 'Dziękujemy! Sprawdź swoją skrzynkę.');
    }

    public function unsubscribe(string $token)
    {
        $sub = Subscriber::where('token', $token)->firstOrFail();

        if (is_null($sub->unsubscribed_at)) {
            $sub->update([
                'status'          => 'unsubscribed',
                'unsubscribed_at' => now(),
            ]);
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
