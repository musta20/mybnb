<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Product;
use App\Models\ShopCart;
use App\Models\WishList;
use App\Services\CartService;
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
    public function addToCart(Listing $product)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Add the product to the user's shopping cart
            WishList::firstOrCreate(
                ["product_id" =>  $product->id],
                ["user_id" => $user->id]
            );
        } else {
            // Add the product to the session cart
            CartService::add(
                (object)  [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image
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
            $cart = CartService::getCart();
        }

        return view('cart',['cart' => $cart]);   
    }


    
    /**
     * A function to remove a product from the cart.
     *
     * @param Product $product The product to be removed from the cart
     * @throws Some_Exception_Class Description of exception
     * @return Some_Return_Value
     */
    public function removeCart(Listing $product){


        if (Auth::check()) {

            $user = Auth::user();

            $productItem =wishList::where('user_id',$user->id)->where('product_id',$product->id)->get();
            
           
             $productItem->first()->delete();

            return redirect()->back()->with('OkToast', __('messages.product removed'));

        }

        CartService::remove($product->id);

        return redirect()->back()->with('OkToast',__('messages.product removed'));
    }
}
