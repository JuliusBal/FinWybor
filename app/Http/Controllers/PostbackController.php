<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostbackController extends Controller
{
    public function handle(Request $r, string $network)
    {
        $clickUuid = $r->input('click_id')
                  ?? $r->input('subid')
                  ?? $r->input('sub_id')
                  ?? $r->input('clickref')
                  ?? null;

        if (!$clickUuid) {
            return response()->json(['error' => 'Missing click identifier (click_id/subid/clickref)'], 422);
        }

        $click = DB::table('clicks')->where('click_uuid', $clickUuid)->first();
        if (!$click) {
            return response()->json(['error' => 'Click not found'], 404);
        }

        $payout   = (float) ($r->input('payout') ?? $r->input('commission') ?? $r->input('amount') ?? 0.0);
        $currency = strtoupper($r->input('currency', 'EUR'));
        $status   = strtolower($r->input('status', 'pending'));
        $extId    = $r->input('conversion_id') ?? $r->input('transaction_id') ?? null;

        $allowedStatus = ['pending','approved','rejected'];
        if (!in_array($status, $allowedStatus)) $status = 'pending';

        $exists = DB::table('conversions')->where('click_id', $click->id)->first();
        if ($exists) {
            DB::table('conversions')->where('id', $exists->id)->update([
                'provider_id'  => $click->provider_id,
                'external_id'  => $extId,
                'status'       => $status,
                'payout_amount'=> $payout,
                'currency'     => $currency,
                'event_time'   => now(),
                'raw_payload'  => json_encode($r->all()),
                'updated_at'   => now(),
            ]);
        } else {
            DB::table('conversions')->insert([
                'click_id'     => $click->id,
                'provider_id'  => $click->provider_id,
                'external_id'  => $extId,
                'status'       => $status,
                'payout_amount'=> $payout,
                'currency'     => $currency,
                'event_time'   => now(),
                'raw_payload'  => json_encode($r->all()),
                'created_at'   => now(), 'updated_at' => now(),
            ]);
        }

        return response()->json(['ok' => true]);
    }
}
