<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Division;
use App\Models\Zila;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.divisions.index');
        $divisions = Division::all();
        return view('backend.pages.divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.divisions.create');
        return view('backend.pages.divisions.create');
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
            'name' => 'required|string|unique:divisions',
        ]);

        $division = new Division;
        $division->name = $request->name;
        $division->slug = Str::slug($request->name);
        $division->status =$request->filled('status');
        $division->creator = Auth::user()->role->name;
        $division->save();

        Toastr::success('Successfully Division Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.divisions.index');
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
        Gate::authorize('admin.divisions.edit');
        $division = Division::findOrFail($id);
        return view('backend.pages.divisions.edit',compact('division'));
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
            'name' => 'required|string|unique:divisions,name,'.$id,
        ]);

        $division = Division::findOrFail($id);

        $division->name = $request->name;
        $division->slug = Str::slug($request->name);
        $division->status =$request->filled('status');
        $division->creator = Auth::user()->role->name;
        $division->save();

        Toastr::success('Successfully Division Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.divisions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.divisions.destroy');
        $division = Division::findOrFail($id);
        if ($division) {
            $division->delete();
            Toastr::success('Successfully Division Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.divisions.index');
    }
}