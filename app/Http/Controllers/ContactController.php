<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use App\Mail\ContactConfirmation;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function create()
    {
        return view('static.contact');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
            'consent' => 'accepted',
        ], [
            'consent.accepted' => 'Musisz wyrazić zgodę na kontakt.',
        ]);

        $to = config('mail.from.address');

        try {
            Mail::to($to)->send(new ContactMessage($data));
            Mail::to($data['email'])->send(new ContactConfirmation($data));

            return back()->with('success', 'Dziękujemy! Wiadomość została wysłana.');
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', [
                'error' => $e->getMessage(),
            ]);
            return back()
                ->withErrors(['email' => 'Nie udało się wysłać wiadomości. Spróbuj ponownie później.'])
                ->withInput();
        }
    }
}
