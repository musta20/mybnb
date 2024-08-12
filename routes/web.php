<?php

use App\Http\Controllers\MainSiteController;
use App\Http\Controllers\Auth\SocialiteAuthController;
use App\Livewire\Host\Booking\Booking;
use App\Livewire\Host\Listing\AddListing;
use App\Livewire\Host\Listing\Bookingrequest;
use App\Livewire\Host\Listing\EditListing;
use App\Livewire\Host\Listing\Listing;
use Illuminate\Support\Facades\Route;

use Livewire\Volt\Volt;

Route::get('/', [MainSiteController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/auth/redirect/{driver}', [SocialiteAuthController::class, 'redirect'])->name('SocialiteRedirect');

Route::get('/auth/callback/{driver}',[SocialiteAuthController::class, 'callback'])->name('SocialiteCallback');



Route::post('AddReview', [MainSiteController::class, 'addReview'])->name('AddReview');

Volt::route('booking/', 'booking-detail')->name('bookingdetail');

//Route::get('host/{user}', [MainSiteController::class, 'host'])->name('host');

Route::get('logout', [MainSiteController::class, 'logout'])->name('logout');

Route::get('listing/{listing}', [MainSiteController::class, 'listing'])->name('listing');

Route::get('hostProfile/{user}', [MainSiteController::class, 'hostProfile'])->name('hostProfile');

Volt::route('booking/{listing}', 'booking')->name('booking');

Route::view('wishList', 'wishList')->name('wishList');

Route::get('addToList/{listing}', [MainSiteController::class, 'addToList'])->name('addToList');

Route::get('removeList/{listing}', [MainSiteController::class, 'removeList'])->name('removeList');

Volt::route('messages/{Messages?}', 'host.messages.messages-component')
    ->name('Message');

Route::view('profile', 'profile')
    ->name('profile');

Route::group(['as' => 'host.', 'middleware' => ['auth', 'host'], 'prefix' => 'host'], function () {

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

    Volt::route('booking/detail/{Booking}', 'host.booking.detail-booking')
        ->name('BookingDetail');
});

require __DIR__ . '/auth.php';
