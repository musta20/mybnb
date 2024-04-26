<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Product;
use App\Models\WishList;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Adds a product to the cart.
     *
     * If the user is authenticated, it adds the product to the user's shopping cart.
     * If the user is not authenticated, it adds the product to the session cart.
     *
     * @param Product $product The product to be added to the cart.
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
                ["listing_id" =>  $listing->id],
                ["user_id" => $user->id]
            );
        } else {
            // Add the product to the session cart
            WishlistService::add(
                (object)  [
                'id' => $listing->id,
                'title' => $listing->title,
                'image' => $listing->media[0]->path
            ]);
        }

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('OkToast', __('messages.product added'));
    }


    public function showCart(){

        if (Auth::check()) {

            $user= Auth::user();
            $cart = $user->products;

        }else{
            $cart = WishlistService::getList();
        }

        return view('List',['List' => $cart]);   
    }


    
    /**
     * A function to remove a product from the cart.
     *
     * @param Product $product The product to be removed from the cart
     * @throws Some_Exception_Class Description of exception
     * @return Some_Return_Value
     */
    public function removeList(Listing $listing){


        if (Auth::check()) {

            $user = Auth::user();

            $productItem =wishList::where('user_id',$user->id)->where('listing_id',$listing->id)->get();
            
           
             $productItem->first()->delete();

            return redirect()->back()->with('OkToast', __('messages.product removed'));

        }

        WishlistService::remove($listing->id);

        return redirect()->back()->with('OkToast',__('messages.product removed'));
    }
}
