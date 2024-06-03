<?php

declare(strict_types=1);

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SetSeoDefaults;
use App\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '{locale?}',
    'middleware' => [SetLocale::class, SetSeoDefaults::class],
], function () {
    Route::get('/', Pages\Home::class)->name('home');
    Route::get('/guide/{country}/{step?}', Pages\Country::class)->name('country');
    Route::get('/about', Pages\About::class)->name('about');
    Route::get('/terms', Pages\Terms::class)->name('terms');
    Route::get('/privacy', Pages\Privacy::class)->name('privacy');
    Route::get('/partners', Pages\Partners::class)->name('partners');
});
