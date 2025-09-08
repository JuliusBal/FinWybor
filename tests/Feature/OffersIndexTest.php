<?php

use App\Models\Offer;

it('lists loan offers sorted by brand by default', function () {
    $b = Offer::factory()->create(['brand' => 'Beta',   'product_type' => 'loan']);
    $a = Offer::factory()->create(['brand' => 'Alpha',  'product_type' => 'loan']);
    $c = Offer::factory()->create(['brand' => 'Charlie','product_type' => 'card']);

    $resp = $this->get(route('offers.index'));
    $resp->assertOk()
        ->assertSee($a->brand)
        ->assertSee($b->brand)
        ->assertDontSee($c->brand);

    $html = $resp->getContent();
    expect(strpos($html, $a->brand))->toBeLessThan(strpos($html, $b->brand));
});


it('can filter by type=loan and show payout labels', function () {
    Offer::factory()->loan()->create(['payout_speed' => 'instant',  'brand' => 'FastCash']);
    Offer::factory()->loan()->create(['payout_speed' => '1_3_days','brand' => 'SlowMoney']);
    Offer::factory()->card()->create(['payout_speed' => 'same_day', 'brand' => 'Cardy']);

    $resp = $this->get(route('offers.index', ['type' => 'loan']));
    $resp->assertOk()
        ->assertSee('FastCash')
        ->assertSee('SlowMoney')
        ->assertDontSee('Cardy')
        ->assertSee('Natychmiast')
        ->assertSee('1–3 dni');
});

it('can sort by cheapest using RRSO ascending (schema-aligned)', function () {
    Offer::factory()->loan()->create(['brand' => 'Brand-A', 'rrso' => 25.00]);
    Offer::factory()->loan()->create(['brand' => 'Brand-B', 'rrso' => 10.00]);
    Offer::factory()->loan()->create(['brand' => 'Brand-C', 'rrso' => 15.00]);

    $resp = $this->get(route('offers.index', ['sort' => 'cheapest']));

    $resp->assertOk()
        ->assertSee('Brand-A')
        ->assertSee('Brand-B')
        ->assertSee('Brand-C')
        ->assertSeeInOrder(['Brand-B', 'Brand-C', 'Brand-A']);
});
