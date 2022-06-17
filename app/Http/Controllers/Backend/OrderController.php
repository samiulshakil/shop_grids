<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function order(){
        $orders = Order::where('status', 'Pending')->get();
        return view('backend.pages.orders.orders', compact('orders'));
    }

    public function viewOrder($id){
        $order = Order::where('id', $id)->with('shipping', 'orderItems', 'user')->firstOrFail();

        return view('backend.pages.orders.view_orders', compact('order'));
    }
}
