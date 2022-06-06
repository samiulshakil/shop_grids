<?php

use App\Models\Category;

if (!function_exists('categories')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function categories()
    {
        return Category::with('subCategories')->where('category_status', 1)->get();
    }
}
