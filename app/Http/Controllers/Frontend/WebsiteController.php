<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class WebsiteController extends Controller
{
    public function index(){
        $products = Product::where('product_status',1)->orderBy('id','DESC')->get();
        return view('frontend.home.home');
    }
}
