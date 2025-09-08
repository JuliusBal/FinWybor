<?php

use Illuminate\Support\Facades\Route;

Route::get('/__t-403', fn () => abort(403));
Route::get('/__t-500', fn () => abort(500));
Route::get('/__t-503', fn () => abort(503));
Route::middleware('throttle:1,1')->get('/__t-429', fn () => 'ok');
Route::post('/__t-419', fn () => abort(419));
