<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Zila;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\Ward;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.wards.index');
        $wards = Ward::all();
        return view('backend.pages.wards.index', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.wards.create');
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::where('status', 1)->get();
        $unions = Union::where('status', 1)->get();
        return view('backend.pages.wards.create', compact('divisions', 'zilas', 'upazilas', 'unions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:wards',
            'division_id' => 'required',
            'zila_id' => 'required',
            'upazila_id' => 'required',
            'union_id' => 'required',
        ]);

        $ward = new Ward;
        $ward->upazila_id = $request->upazila_id;
        $ward->union_id = $request->union_id;
        $ward->zila_id = $request->zila_id;
        $ward->division_id = $request->division_id;
        $ward->name = $request->name;
        $ward->slug = Str::slug($request->name);
        $ward->status =$request->filled('status');
        $ward->creator = Auth::user()->role->name;
        $ward->save();

        Toastr::success('Successfully Ward Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.wards.index');
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
        Gate::authorize('admin.unions.edit');
        $ward = Ward::findOrFail($id);
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::where('status', 1)->get();
        $unions = Union::where('status', 1)->get();
        return view('backend.pages.wards.edit',compact('unions', 'divisions', 'zilas', 'upazilas', 'ward'));
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
        $request->validate([
            'name' => 'required|string|unique:unions,name,'.$id,
            'division_id' => 'required',
            'zila_id' => 'required',
            'upazila_id' => 'required',
            'union_id' => 'required',
        ]);

        $ward = Ward::findOrFail($id);

        $ward->division_id = $request->division_id;
        $ward->upazila_id = $request->upazila_id;
        $ward->union_id = $request->union_id;
        $ward->zila_id = $request->zila_id;
        $ward->name = $request->name;
        $ward->slug = Str::slug($request->name);
        $ward->status =$request->filled('status');
        $ward->creator = Auth::user()->role->name;
        $ward->save();

        Toastr::success('Successfully Ward Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.wards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.wards.destroy');
        $union = Ward::findOrFail($id);
        if ($union) {
            $union->delete();
            Toastr::success('Successfully Upazila Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.wards.index');
    }
}
