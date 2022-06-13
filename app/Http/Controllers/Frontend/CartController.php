<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Cart::content();
         return view('frontend.cart.show', compact('contents'));
    }

    public function ProductInfo(Request $request){
        $product = Product::with(['category', 'brand'])->where('id', $request->id)->first();

        $product_size = $product->product_size;
        $size = explode(",",$product_size);

        $product_color = $product->product_color;
        $color = explode(",",$product_color);

        return response()->json(['product' => $product, 'size' => $size, 'color' => $color]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        Cart::add([
            'id' => $request->id, 
            'name' => $product->product_name, 
            'qty' => $request->qty, 
            'price' => $product->discount_price, 
            'weight' => 1, 
            'options' => ['image' => $product->product_thumbnail, 'size' => $request->product_size, 'color' => $request->product_color],
        ]);

        $cartcount = cartcount();
        $contents = Cart::content();
        $view = view('frontend.partials.cart_popup', compact('contents'));

        $cart_popup = $view->render();

        return response()->json(['message' => 'Product successfully added cart', 'status' => 'success', 'cartcount' => $cartcount, 'cart_popup' => $cart_popup,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json(['message' => 'Successfully updated cart', 'status' => 'success',]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);

        $contents = Cart::content();
        $cartcount = cartcount();
        $view = view('frontend.partials.show_cart', compact('contents'));
        $cart_popup = view('frontend.partials.cart_popup', compact('contents'));

        $cart_show = $view->render();
        $cart_popup = $cart_popup->render();

        return response()->json(['message' => 'Product successfully removed', 'status' => 'success', 'cartcount' => $cartcount, 'cart_show' => $cart_show, 'cart_popup' => $cart_popup]);
    }

    public function checkout(){
        if (Auth::check()) {
            
        }else{
            return redirect()->route('login');
        }
    }
}
