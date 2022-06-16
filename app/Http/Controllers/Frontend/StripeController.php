<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Product;
use Carbon\Carbon;
use Session;
use Auth;
use Cart;

class StripeController extends Controller
{
    public function store(Request $request){

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }else {
            $total_amount = round(Cart::subtotal());
        }

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51LB1RFIIxPDrK9xg6CVe87jCeddc0UALx7LFrGsbLZB6ynz6pij99VrVUtnofmKtmw33OZIIHSPeuaHYd27myI9o00woEsfcLM');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Charge from Shakil',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'payment_type' => 'Stripe',
            'payment_method' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'order_number' => $charge->metadata->order_id,
            'amount' => $total_amount,
            'invoice_no' => '...',
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
        ]);

        //shipping info
        Shipping::create([
            'order_id' => $order->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
        ]);

        $carts = Cart::content();

        foreach ($carts as $cart ) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        //product stock decrement start
        foreach($carts as $pro){
            Product::where('id',$pro->id)->decrement('product_qty',$pro->qty);
        }
        //product stock decrement end
        
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        return Redirect()->route('admin.dashboard');

    }
}
