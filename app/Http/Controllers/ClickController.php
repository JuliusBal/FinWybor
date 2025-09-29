<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClickController extends Controller
{
    public function store(Request $r)
    {
        $r->validate([
            'offer_id' => 'required|integer|exists:offers,id',
            'amount'   => 'nullable|integer|min:100',
            'term'     => 'nullable|integer|min:1|max:120',
            'source'   => 'nullable|string|max:255',
        ]);

        $offer = DB::table('offers')->where('status','active')->where('id', $r->integer('offer_id'))->first();
        if (!$offer || empty($offer->tracking_url)) {
            return back()->with('error', 'Offer not available');
        }

        $clickId = substr(bin2hex(random_bytes(16)), 0, 32);

        $final = $this->buildOutboundUrl($offer->tracking_url, $clickId, [
            'AMOUNT' => (string) $r->integer('amount', 0),
            'TERM'   => (string) $r->integer('term', 0),
        ]);

        if (!$this->isAllowedTrackingUrl($final)) {
            return back()->with('error', 'Tracking URL blocked');
        }

        DB::table('clicks')->insert([
            'click_uuid'  => $clickId,
            'offer_id'    => $offer->id,
            'provider_id' => $offer->provider_id,
            'amount'      => $r->filled('amount') ? (int) $r->input('amount') : null,
            'term_months' => $r->filled('term')   ? (int) $r->input('term')   : null,
            'user_agent'  => substr($r->userAgent() ?? '', 0, 512),
            'ip_hash'     => hash('sha256', $r->ip() ?? ''),
            'referer'     => substr($r->headers->get('referer', ''), 0, 512),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->away($final, 302);
    }

    private function buildOutboundUrl(string $url, string $clickId, array $extra = []): string
    {
        $replaced = strtr($url, [
            '{CLICK_ID}' => $clickId,
            '{SUBID}'    => $clickId,
            '{SubID}'    => $clickId,
            '{subid}'    => $clickId,
            '{AMOUNT}'   => (string)($extra['AMOUNT'] ?? ''),
            '{TERM}'     => (string)($extra['TERM'] ?? ''),
        ]);

        if (strpos($replaced, '{CLICK_ID}') === false
            && strpos($replaced, '{SUBID}') === false
            && stripos($replaced, 'sid=') === false) {

            $parts = parse_url($replaced);
            $qs = [];
            if (!empty($parts['query'])) {
                parse_str($parts['query'], $qs);
            }
            $qs['sid'] = $clickId;

            $rebuilt = ($parts['scheme'] ?? 'https').'://'.$parts['host'].
                (isset($parts['port']) ? ':'.$parts['port'] : '').
                ($parts['path'] ?? '');

            $rebuilt .= '?'.http_build_query($qs);
            if (!empty($parts['fragment'])) {
                $rebuilt .= '#'.$parts['fragment'];
            }
            return $rebuilt;
        }

        return $replaced;
    }

    private function isAllowedTrackingUrl(string $url): bool
    {
        $host = parse_url($url, PHP_URL_HOST) ?: '';
        $allowed = [
            'converti.se',
            'track.awin.com',
            'ad.admitad.com',
        ];
        foreach ($allowed as $a) {
            if ($host === $a || str_ends_with($host, '.'.$a)) return true;
        }
        return false;
    }
}
