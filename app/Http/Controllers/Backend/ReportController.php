<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;

class ReportController extends Controller
{
    public function report(){
        $date = Carbon::now()->format('d F Y');
        $orders = Order::where('status', 'Pending')->where('order_date', $date)->get();
        return view('backend.pages.reports.reports', compact('orders'));
    }

    public function todayDelivered(){
        $date = Carbon::now()->format('d F Y');
        $orders = Order::where('status', 'Delivered')->where('order_date', $date)->get();
        return view('backend.pages.reports.reports', compact('orders'));
    }

    public function thisMonth(){
        $date = Carbon::now()->format('F');
        $orders = Order::where('status', 'Pending')->where('order_month', $date)->get();
        return view('backend.pages.reports.reports', compact('orders'));
    }

    public function searchReport(){
        return view('backend.pages.reports.search');
    }

    public function reportByDate(Request $request){
        $request->validate([
            'date'=>'required',
        ]);

        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');

        $orders = Order::where('status', 'Delivered')->where('order_date',$formatDate)->latest()->get();
        return view('backend.pages.reports.search_reports',compact('orders'));
    }

    public function reportByMonth(Request $request){
        $request->validate([
            'month'=>'required',
        ]);

        $orders = Order::where('status', 'Delivered')->where('order_month',$request->month)->where('order_year',2022)->latest()->get();
         return view('backend.pages.reports.search_reports',compact('orders'));
    }

    public function reportByYear(Request $request){
        $request->validate([
            'year'=>'required',
        ]);

        $orders = Order::where('status', 'Delivered')->where('order_year',$request->year)->latest()->get();
        return view('backend.pages.reports.search_reports',compact('orders'));
    }
}
