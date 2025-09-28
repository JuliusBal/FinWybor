<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{HomeController, OfferController, ClickController, PostController, CategoryController, ContactController, NewsletterController, SitemapController, RobotsController, PostbackController};

/**
 * Load testing-only routes separately
 */
if (app()->environment('testing')) {
    require base_path('routes/testing.php');
}

/**
 * Public site
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages
Route::view('/faq', 'static.faq')->name('faq');
Route::view('/regulamin', 'static.terms')->name('terms');
Route::view('/polityka-prywatnosci', 'static.privacy')->name('privacy');

// Offers
Route::prefix('oferty')->name('offers.')->controller(OfferController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/pozyczki', 'loans')->name('loans');
    Route::get('/karty-kredytowe', 'cards')->name('cards');
    Route::get('/ubezpieczenia', 'insurance')->name('insurance');
});
Route::permanentRedirect('/offers', '/oferty');
//LP
Route::get('/kredyty-gotowkowe', [OfferController::class, 'loansLanding'])
    ->name('offers.loans.landing');

// Blog (posts)
Route::prefix('artykuly')->name('posts.')->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{post:slug}', 'show')->name('show');
});
Route::permanentRedirect('/posts', '/artykuly');

// Categories
Route::prefix('kategoria')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('{category:slug}', 'show')->name('show');
});

// Contact
Route::prefix('kontakt')->name('contact.')->controller(ContactController::class)->group(function () {
    Route::get('/', 'create')->name('create');
    Route::post('/', 'store')->middleware('throttle:10,1')->name('store');
});
Route::view('/o-nas', 'static.about')->name('about');
Route::view('/cookies', 'static.cookies')->name('cookies');

// Newsletter
Route::prefix('newsletter')->name('newsletter.')->controller(NewsletterController::class)->group(function () {
    Route::get('/', 'center')->name('center');
    Route::post('/', 'store')->middleware('throttle:10,1')->name('subscribe');
    Route::post('/unsubscribe-request', 'requestUnsubscribe')->name('requestUnsubscribe');
    Route::get('/unsubscribe/{token}', 'unsubscribe')->name('unsubscribe');
});

// Click tracking
Route::post('/click', [ClickController::class, 'store'])
    ->middleware('throttle:60,1')
    ->name('click.store');

Route::match(['get','post'], '/postback/{network}', [PostbackController::class, 'handle'])
    ->whereIn('network', ['awin'])
    ->middleware('throttle:60,1')
    ->name('postback.handle');

// SEO
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt',  RobotsController::class)->name('robots');

// 404 fallback
Route::fallback(fn () => response()->view('errors.404', [], 404));
