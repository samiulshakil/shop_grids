<?php

use App\Models\Brand;

if (!function_exists('brands')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function brands()
    {
        return Brand::all();
    }
}
