<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class CartService
{
    public static function add($productid): void
    {
        //dd($productid);
        $cart = self::getCart();


        $cartItem = $cart->where('id', $productid->id)->first();
        if (!$cartItem) {

            $cart->push($productid);
            session()->put('cart', $cart);
        }
    }


    public static function remove($productId): void
    {
        $cart = self::getCart();
        
        $cart = $cart->filter(fn($item) => $item->id!= $productId);


        session()->put('cart', $cart);
    }

    public static function getCart()
    {
        return session()->has('cart') ? session()->get('cart') : collect([]);
    }
}
