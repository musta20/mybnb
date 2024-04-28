<?php

use App\Enums\HostType;
use App\Livewire\Host\Booking\Booking;
use App\Livewire\Host\Listing\AddListing;
use App\Livewire\Host\Listing\EditListing;
use App\Livewire\Host\Listing\Listing;
use App\Models\Listing as ModelsListing;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Enums\Status;
use App\Http\Controllers\CartController;
use App\Livewire\Host\Listing\Bookingrequest;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

Route::get(
    '/',

    function () {

        if (request()->filled(['search','start','end','bedrooms'])) {
           
            $listings = ModelsListing::where('status', Status::PUBLISHED->value)->where('title', 'like', '%' . request('search') . '%')->paginate(10);

            return view('index', [
                'listings' => $listings
            ]);
        }

        $listings = ModelsListing::where('status', Status::PUBLISHED->value)->paginate(10);

        return view('index', [
            'listings' => $listings
        ]);
    }
)->name('home');




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::post('Addreview', function (Request $request) {

    Reviews::create([
        'listing_id' => $request->listing_id,
        'rating' => $request->rating,
        'guest_id' => auth()->user()->id,
        'comment' => $request->comment
    ]);

    return redirect()->back();
})->name('Addreview');


Volt::route('booking/','booking-detail')->name('bookingdetail');


Route::get('listing/{listing}', function (ModelsListing $listing) {


    if ($listing->status != Status::PUBLISHED->value) return     abort(404);

    $recomendedProduct = ModelsListing::where('status', Status::PUBLISHED->value)->latest()->take(5)->get();

    $allRating = [
        5 => count($listing->reviews->where('rating', 5)),
        4 => count($listing->reviews->where('rating', 4)),
        3 => count($listing->reviews->where('rating', 3)),
        2 => count($listing->reviews->where('rating', 2)),
        1 => count($listing->reviews->where('rating', 1)),
    ];

    $totalRating = 0;


    if (array_sum($allRating) > 0) {

        $r =   array_map(function ($n, $i) {
            return $n * $i;
        }, $allRating, array_keys($allRating));

        $totalRating = array_sum($r) / array_sum($allRating);
    }

    $reviews =  Reviews::where('listing_id', $listing->id)->paginate(10);
    //$reviews = $listing->reviews->paginate(10); 
    return view('listing', [
        'listing' => $listing,
        'totalRating' => $totalRating,
        'allRating' => $allRating,
        'reviews' => $reviews,
        'recomendedProduct' => $recomendedProduct
    ]);
})->name('listing');

Route::get('hostProfile/{user}', function (User $user) {


    if ($user->type != HostType::HOST->value) return abort(403);
    $listings = ModelsListing::where('status', Status::PUBLISHED->value)->where('host_id', $user->id)->paginate(10);
    return view(
        'hostProfile',
        [
            'user' => $user,
            'listings' => $listings
        ]
    );
})->name('hostProfile');


Volt::route('booking/{listing}','booking')->name('booking');


Route::get('/showCart', function () {

    return view('wishList');
})->name('showCart');

Route::get('/addToList/{listing}', [CartController::class, 'addToList'])->name('addToList');

Route::get('/removeList/{listing}', [CartController::class, 'removeList'])->name('removeList');

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
