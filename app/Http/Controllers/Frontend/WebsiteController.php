<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Blog;

class WebsiteController extends Controller
{
    public function index(){
        $products = Product::with('category')->where('product_status',1)->orderBy('id','DESC')->get();
        $banners = Banner::where('status',1)->get();
        $blogs = Blog::with('category')->where('status',1)->get();
        return view('frontend.home.home', compact('products', 'banners', 'blogs'));
    }

    public function productDetails($slug){
        $product = Product::where('product_status',1)->where('product_slug',$slug)->orderBy('id','DESC')->first();
        return view('frontend.products.product_details', compact('product'));
    }

    public function shop(){
        $products = Product::with('category')->where('product_status',1)->orderBy('id','DESC')->get();
        $category_products = Category::with('products')->withCount('products')->get();
        $brands = Brand::with('products')->withCount('products')->get();
        return view('frontend.products.shop', compact('brands', 'products', 'category_products'));
    }

}
