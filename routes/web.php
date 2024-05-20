<?php

declare(strict_types=1);

use App\Http\Middleware\SetLocale;
use App\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '{locale?}',
    'middleware' => SetLocale::class,
], function () {
    Route::get('/about', Pages\About::class)->name('about');
    Route::get('/partners', Pages\Partners::class)->name('partners');
    Route::get('/{country?}/{step?}', Pages\Home::class)->name('home');
});
