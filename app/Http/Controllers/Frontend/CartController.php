<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
