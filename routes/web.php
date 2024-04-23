<?php

use App\Livewire\Host\Booking\Booking;
use App\Livewire\Host\Listing\AddListing;
use App\Livewire\Host\Listing\EditListing;
use App\Livewire\Host\Listing\Listing;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::group(['as' => 'host.', 'middleware' => ['auth'], 'prefix' => 'host'], function () {

    Route::view('profile', 'profile')
        ->name('profile');

        Route::get('listing', Listing::class)
        ->name('listing');

        Route::get('listing/new', AddListing::class)
        ->name('AddListing');

        Route::get('listing/{listing}', EditListing::class)
        ->name('EditListing');

        Route::get('booking/', Booking::class)
        ->name('Booking');


        Volt::route('messages/{Messages?}', 'host.messages.messages-component')
        ->name('Message');
 
        Volt::route('booking/detail/{Booking}', 'host.booking.detail-booking')
        ->name('BookingDetail');
 


});




require __DIR__ . '/auth.php';
