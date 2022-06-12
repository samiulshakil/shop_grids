<?php

use App\Models\Wishlist;

if (!function_exists('wishlists')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function wishlists()
    {
        return Wishlist::all()->count();
    }
}
