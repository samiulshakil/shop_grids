<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Zila;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ZilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.zilas.index');
        $zilas = Zila::all();
        return view('backend.pages.zilas.index', compact('zilas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.zilas.create');
        $divisions = Division::where('status', 1)->get();
        return view('backend.pages.zilas.create', compact('divisions'));
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
            'name' => 'required|string|unique:zilas',
            'division_id' => 'required'
        ]);

        $zila = new Zila;
        $zila->division_id = $request->division_id;
        $zila->name = $request->name;
        $zila->slug = Str::slug($request->name);
        $zila->status =$request->filled('status');
        $zila->creator = Auth::user()->role->name;
        $zila->save();

        Toastr::success('Successfully Zila Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.zilas.index');
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
        Gate::authorize('admin.zilas.edit');
        $zila = Zila::findOrFail($id);
        $divisions = Division::where('status', 1)->get();
        return view('backend.pages.zilas.edit',compact('zila', 'divisions'));
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
            'name' => 'required|string|unique:zilas,name,'.$id,
            'division_id' => 'required'
        ]);

        $zila = Zila::findOrFail($id);

        $zila->division_id = $request->division_id;
        $zila->name = $request->name;
        $zila->slug = Str::slug($request->name);
        $zila->status =$request->filled('status');
        $zila->creator = Auth::user()->role->name;
        $zila->save();

        Toastr::success('Successfully Zila Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.zilas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.zilas.destroy');
        $zila = Zila::findOrFail($id);
        if ($zila) {
            $zila->delete();
            Toastr::success('Successfully Zila Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.zilas.index');
    }
}
