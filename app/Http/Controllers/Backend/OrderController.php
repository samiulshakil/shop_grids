<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
{
    public function order(){
        $orders = Order::where('status', 'Pending')->get();
        return view('backend.pages.orders.orders', compact('orders'));
    }

    public function payment(){
        $orders = Order::where('status', 'Accept Payment')->get();
        return view('backend.pages.orders.orders', compact('orders'));
    }

    public function progress(){
        $orders = Order::where('status', 'Progress')->get();
        return view('backend.pages.orders.orders', compact('orders'));
    }

    public function delivered(){
        $orders = Order::where('status', 'Delivered')->get();
        return view('backend.pages.orders.orders', compact('orders'));
    }

    public function cancel(){
        $orders = Order::where('status', 'Cancel')->get();
        return view('backend.pages.orders.orders', compact('orders'));
    }

    public function paymentOrder($id){
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Accept Payment']);
        Toastr::success('Successfully Payment Accept Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function progressOrder($id){
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Progress']);
        Toastr::success('Successfully Prgress Order Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function deliveredOrder($id){
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Delivered']);
        Toastr::success('Successfully Delivered Order Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function cancelOrder($id){
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Cancel']);
        Toastr::success('Successfully Delivered Order Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function viewOrder($id){
        $order = Order::where('id', $id)->with('shipping', 'orderItems', 'user')->firstOrFail();

        return view('backend.pages.orders.view_orders', compact('order'));
    }
}
