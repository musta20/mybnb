<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\HostType;
use App\Enums\Status;
use App\Models\Listing;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use App\Models\WishList;
use App\Services\WishlistService;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainSiteController extends Controller
{
    public function index()
    {
        if (request()->filled(['pageCity'])) {
            return view('index', [
                'listings' => Listing::where('city', request('pageCity'))->where('status', Status::PUBLISHED->value)->paginate(10),
            ]);
        }

        if (request()->filled(['search']) || request()->filled(['start']) || request()->filled(['end']) || request()->filled(['bedrooms'])) {

            // $startDate = request('start');

            $query = Listing::query();

            $city = request('city') == 'المدينة' ? null : request('city');

            $searchWord = request('search');

            $beds = request('bedrooms');

            $query->where(function (Builder $subQuery) use ($searchWord) {
                $subQuery->where('title', 'like', "%{$searchWord}%")
                    ->orWhere('description', 'like', "%{$searchWord}%")
                    ->orWhere('address', 'like', "%{$searchWord}%");
            });

            $query->where('status', Status::PUBLISHED->value);

            if ($beds) {
                $query->where('number_of_bedrooms', '>=', $beds);
            }

            if ($city) {
                $query->where('city', $city);
            }

            // if ($startDate) $query->join('bookings', function (JoinClause $join) use ($startDate) {
            //     $data=Carbon::parse($startDate)->format('Y-m-d');
            //     $join->on('bookings.listing_id', '=', 'listings.id')
            //         ->where('bookings.check_out_date', '=',  $data)
            //         ->where('bookings.status',  BookingStatus::PENDING->value)
            //         ->orWHere('bookings.status',  BookingStatus::ACTIVE->value);
            // });

            return view('index', [
                'listings' => $query->paginate(5),
            ]);
        }

        $listings = Listing::where('status', Status::PUBLISHED->value)->paginate(10);

        return view('index', [
            'listings' => $listings,
        ]);
    }

    public function addReview(Request $request)
    {

        Reviews::create([
            'listing_id' => $request->listing_id,
            'rating' => $request->rating,
            'guest_id' => auth()->user()->id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function listing(Listing $listing)
    {

        if ($listing->status != Status::PUBLISHED->value) {
            return abort(404);
        }

        $recomendedProduct = Listing::where('status', Status::PUBLISHED->value)->latest()->take(5)->get();

        $allRating = [
            5 => count($listing->reviews->where('rating', 5)),
            4 => count($listing->reviews->where('rating', 4)),
            3 => count($listing->reviews->where('rating', 3)),
            2 => count($listing->reviews->where('rating', 2)),
            1 => count($listing->reviews->where('rating', 1)),
        ];

        $totalRating = 0;

        if (array_sum($allRating) > 0) {

            $r = array_map(function ($n, $i) {
                return $n * $i;
            }, $allRating, array_keys($allRating));

            $totalRating = array_sum($r) / array_sum($allRating);
        }

        $hasBooking = $listing->bookings()->max('check_out_date');

        $reviews = Reviews::where('listing_id', $listing->id)->paginate(10);

        return view('listing', [
            'listing' => $listing,
            'totalRating' => $totalRating,
            'allRating' => $allRating,
            'reviews' => $reviews,
            'avalbleDate' => Carbon::parse($hasBooking)->format('F j, Y'),
            'recomendedProduct' => $recomendedProduct,
        ]);
    }

    public function hostProfile(User $user)
    {

        if ($user->type != HostType::HOST->value) {
            return abort(403);
        }
        $listings = Listing::where('status', Status::PUBLISHED->value)->where('host_id', $user->id)->paginate(10);

        return view(
            'hostProfile',
            [
                'user' => $user,
                'listings' => $listings,
            ]
        );
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * Adds a product to the cart.
     *
     * If the user is authenticated, it adds the product to the user's shopping cart.
     * If the user is not authenticated, it adds the product to the session cart.
     *
     * @param  Product  $product  The product to be added to the cart.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success message.
     */
    public function addToList(Listing $listing)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Add the product to the user's shopping cart
            WishList::firstOrCreate(
                ['listing_id' => $listing->id],
                ['user_id' => $user->id]
            );
        } else {
            // Add the product to the session cart
            WishlistService::add(
                (object) [
                    'id' => $listing->id,
                    'title' => $listing->title,
                    'image' => $listing->media[0]->path,
                ]
            );
        }

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('OkToast', __('messages.listing added'));
    }

    public function wishListPage()
    {

        if (Auth::check()) {

            $user = Auth::user();
            $cart = $user->products;
        } else {
            $cart = WishlistService::getList();
        }

        return view('List', ['List' => $cart]);
    }

    /**
     * A function to remove a product from the cart.
     *
     * @param  Product  $product  The product to be removed from the cart
     * @return Some_Return_Value
     *
     * @throws Some_Exception_Class Description of exception
     */
    public function removeList(Listing $listing)
    {

        if (Auth::check()) {

            $user = Auth::user();

            $productItem = wishList::where('user_id', $user->id)->where('listing_id', $listing->id)->get();

            $productItem->first()->delete();

            return redirect()->back()->with('OkToast', __('messages.listing removed'));
        }

        WishlistService::remove($listing->id);

        return redirect()->back()->with('OkToast', __('messages.listing removed'));
    }
}
