<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Location;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Session;
use Cart;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        // return Session::get('coupon');
        $contents = Cart::content();
        return view('frontend.cart.show', compact('contents'));
    }

    public function ProductInfo(Request $request)
    {
        $product = Product::with(['category', 'brand'])
            ->where('id', $request->id)
            ->first();

        $product_size = $product->product_size;
        $size = explode(',', $product_size);

        $product_color = $product->product_color;
        $color = explode(',', $product_color);

        return response()->json(['product' => $product, 'size' => $size, 'color' => $color]);
    }

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

        return response()->json(['message' => 'Product successfully added cart', 'status' => 'success', 'cartcount' => $cartcount, 'cart_popup' => $cart_popup]);
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;
        Cart::update($rowId, ['qty' => $qty]);

        if (Session::has('coupon')) {
            // $sub_total = str_replace(',', '', Cart::subtotal());

            $code = Session::get('coupon')['code'];
            $coupon = Coupon::where('code', $code)
                ->where('expire', '>=', strtotime(Carbon::now()->format('Y-m-d')))
                ->first();

            Session::put('coupon', [
                'code' => $coupon->code,
                'value' => $coupon->value,
                'type' => $coupon->type,
                'discount_amount' => $coupon->type == 'percent' ? round((Cart::subtotal() * $coupon->value) / 100) : round($coupon->value),
                'total_amount' => round(Cart::subtotal() - ($coupon->type == 'percent' ? round((Cart::subtotal() * $coupon->value) / 100) : round($coupon->value))),
            ]);
        }
        $subtotal = Cart::subtotal();
        return response()->json(['message' => 'Successfully updated cart', 'status' => 'success', 'subtotal' => $subtotal]);
    }

    public function destroy(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $contents = Cart::content();
        $cartcount = cartcount();
        $view = view('frontend.partials.show_cart', compact('contents'));
        $cart_popup = view('frontend.partials.cart_popup', compact('contents'));

        $cart_show = $view->render();
        $cart_popup = $cart_popup->render();

        return response()->json(['message' => 'Product successfully removed', 'status' => 'success', 'cartcount' => $cartcount, 'cart_show' => $cart_show, 'cart_popup' => $cart_popup]);
    }

    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)
            ->where('expire', '>=', strtotime(Carbon::now()->format('Y-m-d')))
            ->first();

        // $sub_total = str_replace(',', '', Cart::subtotal());

        if ($coupon) {
            Session::put('coupon', [
                'code' => $coupon->code,
                'value' => $coupon->value,
                'type' => $coupon->type,
                'discount_amount' => $coupon->type == 'percent' ? round((Cart::subtotal() * $coupon->value) / 100) : round($coupon->value),
                'total_amount' => round(Cart::subtotal() - ($coupon->type == 'percent' ? round((Cart::subtotal() * $coupon->value) / 100) : round($coupon->value))),
            ]);
            return response()->json([
                'message' => 'Coupon Applied Success',
                'status' => 'success',
                'subtotal' => Cart::subtotal(),
                'code' => session()->get('coupon')['code'],
                'value' => session()->get('coupon')['value'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid Coupon',
                'status' => 'error',
            ]);
        }
    }

    //coupon calculation
    public function couponCalcaultion(){
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'code' => session()->get('coupon')['code'],
                'coupon_discount' => session()->get('coupon')['value'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else {
            return response()->json(array(
                'total' => Cart::subtotal(),
            ));
        }
    }


}
