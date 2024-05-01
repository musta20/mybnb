<?php

use App\Livewire\Host\Booking\Booking;
use App\Livewire\Host\Listing\AddListing;
use App\Livewire\Host\Listing\EditListing;
use App\Livewire\Host\Listing\Listing;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\MainSiteController;
use App\Livewire\Host\Listing\Bookingrequest;


Route::get('/',[MainSiteController::class, 'index'])->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('Addreview',[MainSiteController::class, 'Addreview'])->name('Addreview');

Volt::route('booking/', 'booking-detail')->name('bookingdetail');

Route::get('listing/{listing}',[MainSiteController::class,'listing'])->name('listing');

Route::get('hostProfile/{user}',[MainSiteController::class,'hostProfile'])->name('hostProfile');

Volt::route('booking/{listing}', 'booking')->name('booking');

Route::view('/wishList','wishList')->name('wishList');

Route::get('/addToList/{listing}', [MainSiteController::class, 'addToList'])->name('addToList');

Route::get('/removeList/{listing}', [MainSiteController::class, 'removeList'])->name('removeList');

Route::group(['as' => 'host.', 'middleware' => ['auth'], 'prefix' => 'host'], function () {

    Route::view('profile', 'profile')
        ->name('profile');


    Route::get('BookingRequests', Bookingrequest::class)
        ->name('BookingRequests');

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
