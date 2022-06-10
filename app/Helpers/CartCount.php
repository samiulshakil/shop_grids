<?php

if (!function_exists('cartcount')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function cartcount()
    {
        return Cart::content()->count();
    }
}
