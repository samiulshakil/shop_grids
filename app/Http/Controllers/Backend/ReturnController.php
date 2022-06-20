<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;

class ReturnController extends Controller
{
    public function returnOrder(){
        $orders = Order::where('return_order', 1)->get();
        return view('backend.pages.orders.return_orders', compact('orders'));
    }

    public function returnOrderApprove($id){
        $order = Order::where('id', $id)->first();

        $order->update([
            'return_order' => 2,
        ]);

        Toastr::success('Order Return Request Approved', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.return.orders');
    }

        public function approvedOrder(){
        $orders = Order::where('return_order', 2)->get();
        return view('backend.pages.orders.return_orders', compact('orders'));
    }
}
