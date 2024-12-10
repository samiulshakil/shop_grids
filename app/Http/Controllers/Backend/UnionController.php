<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Zila;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.unions.index');
        $unions = Union::all();
        return view('backend.pages.unions.index', compact('unions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.unions.create');
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::where('status', 1)->get();
        return view('backend.pages.unions.create', compact('divisions', 'zilas', 'upazilas'));
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
            'name' => 'required|string|unique:unions',
            'division_id' => 'required',
            'zila_id' => 'required',
            'upazila_id' => 'required',
        ]);

        $union = new Union;
        $union->upazila_id = $request->upazila_id;
        $union->zila_id = $request->zila_id;
        $union->division_id = $request->division_id;
        $union->name = $request->name;
        $union->slug = Str::slug($request->name);
        $union->status =$request->filled('status');
        $union->creator = Auth::user()->role->name;
        $union->save();

        Toastr::success('Successfully Zila Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.unions.index');
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
        $union = Union::findOrFail($id);
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::where('status', 1)->get();
        return view('backend.pages.unions.edit',compact('union', 'divisions', 'zilas', 'upazilas'));
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
        ]);

        $union = Union::findOrFail($id);

        $union->division_id = $request->division_id;
        $union->upazila_id = $request->upazila_id;
        $union->zila_id = $request->zila_id;
        $union->name = $request->name;
        $union->slug = Str::slug($request->name);
        $union->status =$request->filled('status');
        $union->creator = Auth::user()->role->name;
        $union->save();

        Toastr::success('Successfully Zila Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.unions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.unions.destroy');
        $union = Union::findOrFail($id);
        if ($union) {
            $union->delete();
            Toastr::success('Successfully Zila Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.unions.index');
    }
}
