<?php

use Illuminate\Support\Facades\URL;

beforeEach(function () {
    config(['app.url' => 'https://FinWybor.pl']);
    URL::forceRootUrl('https://FinWybor.pl');
    URL::forceScheme('https');
});

it('canonicalizes offers default params', function () {
    $resp = $this->get(route('offers.index', [
        'type'=>'loan','amount'=>3000,'term'=>6,'sort'=>'brand','page'=>1,
    ]));

    $html = str_replace('&amp;', '&', $resp->getContent()); // normalize
    expect($html)->toContain('<link rel="canonical" href="https://FinWybor.pl/oferty?type=loan&amount=3000&term=6">');
});

it('drops utm and sorts keys', function () {
    $resp = $this->get('/oferty?utm_source=ggl&term=6&amount=3000&type=loan&gclid=123');
    $html = str_replace('&amp;', '&', $resp->getContent());
    expect($html)->toContain('<link rel="canonical" href="https://FinWybor.pl/oferty?type=loan&amount=3000&term=6">');
});
