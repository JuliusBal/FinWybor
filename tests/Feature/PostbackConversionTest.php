<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


uses(RefreshDatabase::class);

function makeClickForOffer($offer): object {
    $uuid = (string) Str::uuid();
    DB::table('clicks')->insert([
        'click_uuid'  => $uuid,
        'offer_id'    => $offer->id,
        'provider_id' => $offer->provider_id,
        'amount'      => 3000,
        'term_months' => 6,
        'user_agent'  => 'Mozilla/5.0 (Test)',
        'ip_hash'     => hash('sha256', '127.0.0.1'),
        'referer'     => 'http://localhost/test',
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);

    return DB::table('clicks')->where('click_uuid', $uuid)->first();
}

it('accepts a valid postback and creates a conversion (click_id param)', function () {
    $offer = Offer::factory()->create();
    $click = makeClickForOffer($offer);

    $res = $this->get(route('api.postback.handle', [
        'network'  => 'generic',
        'click_id' => $click->click_uuid,
        'status'   => 'approved',
        'payout'   => '12.34',
        'currency' => 'pln',
        'conversion_id' => 'TX-1',
    ]));

    $res->assertOk()->assertJson(['ok' => true]);

    $conv = DB::table('conversions')->where('click_id', $click->id)->first();
    expect($conv)->not->toBeNull();
    expect($conv->provider_id)->toBe($offer->provider_id);
    expect($conv->external_id)->toBe('TX-1');
    expect($conv->status)->toBe('approved');
    expect((float) $conv->payout_amount)->toBe(12.34);
    expect($conv->currency)->toBe('PLN');
});

it('is idempotent: updates same conversion on duplicate postback', function () {
    $offer = Offer::factory()->create();
    $click = makeClickForOffer($offer);

    $this->get(route('api.postback.handle', [
        'network'  => 'generic',
        'click_id' => $click->click_uuid,
        'status'   => 'approved',
        'payout'   => '1.00',
        'currency' => 'EUR',
        'conversion_id' => 'ABC-1',
    ]))->assertOk();

    $this->get(route('api.postback.handle', [
        'network'  => 'generic',
        'click_id' => $click->click_uuid,
        'status'   => 'rejected',
        'payout'   => '0.00',
        'currency' => 'EUR',
        'conversion_id' => 'ABC-1',
    ]))->assertOk();

    $rows = DB::table('conversions')->where('click_id', $click->id)->get();
    expect($rows)->toHaveCount(1);
    expect($rows->first()->status)->toBe('rejected');
    expect((float) $rows->first()->payout_amount)->toBe(0.0);
});

it('normalizes unknown status to pending', function () {
    $offer = Offer::factory()->create();
    $click = makeClickForOffer($offer);

    $this->get(route('api.postback.handle', [
        'network'  => 'generic',
        'click_id' => $click->click_uuid,
        'status'   => 'weird-status',
    ]))->assertOk();

    $conv = DB::table('conversions')->where('click_id', $click->id)->first();
    expect($conv->status)->toBe('pending');
});

it('supports subid|sub_id|clickref parameters', function () {
    $offer = Offer::factory()->create();
    $click = makeClickForOffer($offer);

    foreach (['subid','sub_id','clickref'] as $param) {
        DB::table('conversions')->where('click_id', $click->id)->delete();

        $this->get(route('api.postback.handle', array_merge([
            'network' => 'generic',
            'status'  => 'approved',
        ], [$param => $click->click_uuid])))
            ->assertOk();

        expect(DB::table('conversions')->where('click_id', $click->id)->exists())->toBeTrue();
    }
});

it('returns 404 when click not found', function () {
    $this->get(route('api.postback.handle', [
        'network'  => 'generic',
        'click_id' => (string) Str::uuid(),
    ]))->assertStatus(404)->assertJson(['error' => 'Click not found']);
});

it('returns 422 when click identifier is missing', function () {
    $this->get(route('api.postback.handle', [
        'network'  => 'generic',
    ]))->assertStatus(422)->assertJsonStructure(['error']);
});
