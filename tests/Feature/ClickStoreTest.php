<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('stores a click and redirects with tokens replaced', function () {
    $offer = Offer::factory()->create([
        'tracking_url' => 'https://t.example/click?cid={CLICK_ID}&sub={SUBID}&a={AMOUNT}&t={TERM}',
    ]);

    $this->withoutMiddleware(VerifyCsrfToken::class);

    $resp = $this->post(route('click.store'), [
        'offer_id' => $offer->id,
        'amount'   => 3000,
        'term'     => 6,
    ]);

    $resp->assertRedirect();

    $click = DB::table('clicks')->latest('id')->first();
    expect($click)->not->toBeNull();
    expect($click->offer_id)->toBe($offer->id);
    expect($click->provider_id)->toBe($offer->provider_id);
    expect($click->amount)->toBe(3000);
    expect($click->term_months)->toBe(6);
    expect(strlen($click->click_uuid))->toBe(36);

    $target = $resp->headers->get('Location');
    expect($target)->toContain('cid='.$click->click_uuid);
    expect($target)->toContain('sub='.$click->click_uuid);
    expect($target)->toContain('a=3000');
    expect($target)->toContain('t=6');
});

it('rejects invalid payload: non-existing offer, too-small amount, invalid term', function () {
    $this->withoutMiddleware(VerifyCsrfToken::class);

    $resp = $this->post(route('click.store'), [
        'offer_id' => 999999,
        'amount'   => 50,
        'term'     => 0,
    ]);

    $resp->assertStatus(302)
    ->assertSessionHasErrors([
        'offer_id',
        'amount',
        'term',
    ]);
});

it('allows nullable amount and term', function () {
    $offer = Offer::factory()->create(['tracking_url' => 'https://t.example/click?cid={CLICK_ID}']);

    $this->withoutMiddleware(VerifyCsrfToken::class);

    $resp = $this->post(route('click.store'), [
        'offer_id' => $offer->id,
    ]);

    $resp->assertRedirect();

    $click = DB::table('clicks')->latest('id')->first();
    expect($click->amount)->toBeNull();
    expect($click->term_months)->toBeNull();
});
