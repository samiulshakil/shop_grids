<?php

if (!function_exists('cartcontents')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function cartcontents()
    {
        return Cart::content();
    }
}
