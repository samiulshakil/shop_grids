<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;

class WebsiteController extends Controller
{
    public function index(){
        $products = Product::with('category')->where('product_status',1)->orderBy('id','DESC')->get();
        $banners = Banner::where('status',1)->get();
        return view('frontend.home.home', compact('products', 'banners'));
    }
}
