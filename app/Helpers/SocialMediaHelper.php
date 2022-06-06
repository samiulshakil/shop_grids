<?php

use App\Models\SocialMedia;

if (!function_exists('socialmedias')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function socialmedias()
    {
        return SocialMedia::where('status', 1)->get();
    }
}
