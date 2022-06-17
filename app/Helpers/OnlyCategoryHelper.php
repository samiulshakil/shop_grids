<?php

use App\Models\Category;

if (!function_exists('onlyCategories')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function onlyCategories()
    {
        return Category::where('category_status', 1)->take(5)->get();
    }
}
