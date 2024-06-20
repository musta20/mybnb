<?php

namespace App\Services;

class WishlistService
{
    public static function add($productid): void
    {
        //dd($productid);
        $cart = self::getList();

        $cartItem = $cart->where('id', $productid->id)->first();
        if (! $cartItem) {

            $cart->push($productid);
            session()->put('List', $cart);
        }
    }

    public static function remove($productId): void
    {
        $cart = self::getList();

        $cart = $cart->filter(fn ($item) => $item->id != $productId);

        session()->put('List', $cart);
    }

    public static function getList()
    {
        return session()->has('List') ? session()->get('List') : collect([]);
    }
}
