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
use App\Models\Booking as ModelsBooking;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

Route::get(
    '/',

    function () {

        $listings = ModelsListing::where('status', Status::PUBLISHED->value)->paginate(10);

        return view('index', [
            'listings' => $listings
        ]);
    }
);

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








Route::get('booking/{booking}', function (ModelsBooking $booking) {

    return view('booking-detail', [
        'booking' => $booking
    ]);
})->name('booking-detail');





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

Route::post('saveBooking/{listing}', function (ModelsListing $listing, Request $request) {


    ModelsBooking::create([
        'listing_id' => $listing->id,
        'guest_id' => auth()->user()->id,
        'check_in_date' => $request->start,
        'check_out_date' => $request->end,
        'total_price' => $listing->price_per_night * $request->beds

    ]);

    return;
})->name('saveBooking');

Route::post('booking/{listing}', function (ModelsListing $listing, Request $request) {


    if ($listing->status != Status::PUBLISHED->value) return     abort(404);

    $beds = $request->bedrooms;
    $start = $request->start;
    $end = $request->end;


    $startDate = \Carbon\Carbon::parse($start);

    $endDate = \Carbon\Carbon::parse($end);

    $numberOfDays = $startDate->diffInDays($endDate) + 1; // add 1 because the diffInDays does not include the end date

    $price = $listing->price_per_night * $numberOfDays;

    return view('booking', [
        'listing' => $listing,
        'price' => $price,
        'beds' => $beds,
        'start' => $start,
        'end' => $end

    ]);
})->name('booking');

//showCart
Route::get('/showCart', function () {




    return view('wishList');
})->name('showCart');

Route::get('/addToList/{listing}', [CartController::class, 'addToList'])->name('addToList');
Route::get('/removeList/{listing}', [CartController::class, 'removeList'])->name('removeList');

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
