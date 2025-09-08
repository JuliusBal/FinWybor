<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\PostbackController;

Route::get('/offers', [OfferController::class, 'apiIndex'])->name('api.offers.index');
Route::post('/click', [ClickController::class, 'store'])->name('api.click.store');
Route::middleware('throttle:30,1')->match(['GET','POST'], '/postback/{network}', [PostbackController::class, 'handle'])
    ->name('api.postback.handle');
