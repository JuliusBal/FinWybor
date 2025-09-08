<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClickController extends Controller
{
    public function store(Request $r)
    {
        $r->validate([
            'offer_id' => 'required|integer|exists:offers,id',
            'amount'   => 'nullable|integer|min:100',
            'term'     => 'nullable|integer|min:1|max:120',
        ]);

        $offer = DB::table('offers')->where('id', $r->integer('offer_id'))->first();
        if (!$offer) return back()->with('error', 'Offer not found');

        $uuid = (string) Str::uuid();

        DB::table('clicks')->insert([
            'click_uuid' => $uuid,
            'offer_id' => $offer->id,
            'provider_id' => $offer->provider_id,
            'amount'      => $r->filled('amount') ? (int) $r->input('amount') : null,
            'term_months' => $r->filled('term')   ? (int) $r->input('term')   : null,
            'user_agent'  => substr($r->userAgent() ?? '', 0, 512),
            'ip_hash'     => hash('sha256', $r->ip() ?? ''),
            'referer'     => substr($r->headers->get('referer', ''), 0, 512),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $url = $offer->tracking_url ?? '';
        $final = strtr($url, [
            '{CLICK_ID}' => $uuid,
            '{SUBID}' => $uuid,
            '{AMOUNT}' => (string) $r->integer('amount', 0),
            '{TERM}' => (string) $r->integer('term', 0),
        ]);

        if (!$final) {
            return back()->with('error', 'Tracking URL missing');
        }
        return redirect()->away($final, 302);
    }
}
