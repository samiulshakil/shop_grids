<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Blog;
use App\Models\Order;

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

    public function blogDetails($id){
        $blog = Blog::where('id', $id)->where('status',1)->first();
        return view('frontend.blogs.blog_details', compact('blog'));
    }

    public function trackOrders(Request $request){
        $order = Order::where('order_number', $request->order_number)->with('shipping')->first();
        if ($order) {
            return view('frontend.track.track_order', compact('order'));
        } else {
            Toastr::warning('Order not found', '', ["positionClass" => "toast-top-right"]);
            return redirect()->route('website.home');
        }

    }

    public function shopSearch(Request $request){
        $products = Product::with('category')->where('product_status',1)->where('product_name', 'LIKE', "%{$request->product_search}%")->orderBy('id','DESC')->get();
        $category_products = Category::with('products')->withCount('products')->get();
        $brands = Brand::with('products')->withCount('products')->get();
        return view('frontend.products.shop', compact('brands', 'products', 'category_products'));
    }

    public function categoryProduct($id){
        $products = Product::with('category')->where('product_status',1)->where('category_id', $id)->orderBy('id','DESC')->get();
        $category_products = Category::with('products')->withCount('products')->get();
        $brands = Brand::with('products')->withCount('products')->get();
        return view('frontend.products.shop', compact('brands', 'products', 'category_products'));
    }

    public function brandProduct($id){
        $products = Product::with('category')->where('product_status',1)->where('brand_id', $id)->orderBy('id','DESC')->get();
        $category_products = Category::with('products')->withCount('products')->get();
        $brands = Brand::with('products')->withCount('products')->get();
        return view('frontend.products.shop', compact('brands', 'products', 'category_products'));
    }


}
