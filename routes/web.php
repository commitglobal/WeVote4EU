<?php

declare(strict_types=1);

use App\Http\Middleware\SetLocale;
use App\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '{locale?}',
    'middleware' => SetLocale::class,
], function () {
    Route::get('/', Pages\Home::class)->name('home');
    Route::get('/guide/{country}/{step?}', Pages\Country::class)->name('country');
    Route::get('/about', Pages\About::class)->name('about');
});
