<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Session;
use Cart;
use Auth;

class CheckoutController extends Controller
{
        public function checkout()
    {
        if (Auth::check()) {

            if (Cart::subtotal() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::subtotal();
                $districts = Location::where('parent_id', 0)->orderBy('location_name', 'asc')->get();
                return view('frontend.checkout.checkout', compact('carts', 'cartQty', 'cartTotal', 'districts'));
           }else {
                return redirect()->route('website.home');
           }
        } else {
            return redirect()->route('login');
        }
    }

    public function upazilaList(Request $request)
    {
        if ($request->ajax()) {
            if ($request->district_id) {
                $output = '<option value="">Select Please</option>';
                $upazilas = Location::where('parent_id', $request->district_id)->orderBy('location_name', 'asc')->get();
                if (!$upazilas->isEmpty()) {
                    foreach ($upazilas as $value) {
                        $output .= '<option value="' . $value->id . '">' . $value->location_name . '</option>';
                    }
                }
                return response()->json($output);
            }
        }
    }
}
