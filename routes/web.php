<?php

use App\Livewire\Host\Listing\EditListing;
use App\Livewire\Host\Listing\Listing;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::group(['as' => 'host.', 'middleware' => ['auth'], 'prefix' => 'host'], function () {

    Route::view('profile', 'profile')
        ->name('profile');

        Route::get('listing', Listing::class)
        ->name('listing');

        Route::get('listing/{listing}', EditListing::class)
        ->name('EditListing');

});




require __DIR__ . '/auth.php';
