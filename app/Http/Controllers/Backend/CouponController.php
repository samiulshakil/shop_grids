<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.coupons.index');
        $coupons = Coupon::all();
        return view('backend.pages.coupons.index', compact('coupons'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.coupons.create');
        return view('backend.pages.coupons.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin.coupons.create');

        $request->validate([
            'code' => 'required|string|unique:coupons',
            'type' => 'required|string',
            'value' => 'required',
            'expire' => 'required',
        ]);

        Coupon::create([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expire' => $request->expire,
            'status' => $request->filled('status'),
        ]);

        Toastr::success('Successfully Coupon Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.coupons.index');
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
        Gate::authorize('admin.coupons.edit');
        $coupon = Coupon::where('id', $id)->firstOrFail();
        return view('backend.pages.coupons.edit', compact('coupon'));
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
        Gate::authorize('admin.coupons.edit');

        $coupon = Coupon::find($request->id);

        $request->validate([
            'code' => 'required|string|unique:coupons,code,'.$request->id,
            'type' => 'required|string',
            'value' => 'required',
            'expire' => 'required',
        ]);

        $coupon->update([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expire' => $request->expire,
            'status' => $request->filled('status'),
        ]);

        Toastr::success('Successfully Coupons Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.coupons.destroy');
        $coupon = Coupon::findOrFail($id);
        if ($coupon) {
            $coupon->delete();
            Toastr::success('Successfully Coupons Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.coupons.index');
    }
}
