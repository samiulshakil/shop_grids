<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function paymentProcess(Request $request){

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['district_id'] = $request->district_id;
        $data['upazila_id'] = $request->upazila_id;
        $data['state'] = $request->state;
        $data['postal_code'] = $request->postal_code;
        $data['payment'] = $request->payment;

        if ($request->payment == 'stripe') {
            return view('frontend.payment.stripe', compact('data'));
        }elseif ($request->payment == 'paypal') {
            
        }elseif ($request->payment == 'visa') {
           
        }else{
            echo 'HandCash';
        }
    }
}
