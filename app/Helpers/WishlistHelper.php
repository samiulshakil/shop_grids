<?php

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

if (!function_exists('wishlists')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function wishlists()
    {
        return Wishlist::where('user_id', Auth::id())->count();
    }
}
