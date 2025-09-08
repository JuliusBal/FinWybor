<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('static.contact');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('success', 'Dziękujemy! Wiadomość została wysłana.');
    }
}
