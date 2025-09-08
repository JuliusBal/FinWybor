<?php

use Illuminate\Support\Facades\Route;

it('shows custom 404 page', function () {
    config(['app.debug' => false]);

    $this->get('/i-dont-exist-xyz')
        ->assertNotFound()
        ->assertSee('Nie znaleziono strony')
        ->assertSee('Kod błędu: 404');
});

it('shows custom 500 page', function () {
    config(['app.debug' => false]);

    $this->get('/__t-500')
        ->assertStatus(500)
        ->assertSee('Wewnętrzny błąd serwera')
        ->assertSee('Kod błędu: 500');
});

it('shows custom 403 page', function () {
    config(['app.debug' => false]);

    $this->get('/__t-403')
        ->assertStatus(403)
        ->assertSee('Dostęp zabroniony')
        ->assertSee('Kod błędu: 403');
});

it('shows custom 419 page (CSRF)', function () {
    config(['app.debug' => false]);

    $this->post('/__t-419', []) // no CSRF token on purpose
    ->assertStatus(419)
        ->assertSee('Sesja wygasła')
        ->assertSee('Kod błędu: 419');
});

it('shows custom 429 page (rate limit)', function () {
    config(['app.debug' => false]);

    $this->get('/__t-429')->assertOk();
    $this->get('/__t-429')
        ->assertStatus(429)
        ->assertSee('Za dużo żądań')
        ->assertSee('Kod błędu: 429');
});

it('shows custom 503 page', function () {
    config(['app.debug' => false]);

    $this->get('/__t-503')
        ->assertStatus(503)
        ->assertSee('Serwis niedostępny')
        ->assertSee('Kod błędu: 503');
});
