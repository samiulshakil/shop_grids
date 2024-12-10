<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Zila;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.upazilas.index');
        $upazilas = Upazila::all();
        return view('backend.pages.upazilas.index', compact('upazilas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.upazilas.create');
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        return view('backend.pages.upazilas.create', compact('divisions', 'zilas'));
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
            'name' => 'required|string|unique:upazilas',
            'division_id' => 'required',
            'zila_id' => 'required',
        ]);

        $upazila = new Upazila;
        $upazila->zila_id = $request->zila_id;
        $upazila->division_id = $request->division_id;
        $upazila->name = $request->name;
        $upazila->slug = Str::slug($request->name);
        $upazila->status =$request->filled('status');
        $upazila->creator = Auth::user()->role->name;
        $upazila->save();

        Toastr::success('Successfully Upazila Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.upazilas.index');
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
        Gate::authorize('admin.upazilas.edit');
        $upazila = Upazila::findOrFail($id);
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        return view('backend.pages.upazilas.edit',compact('upazila', 'divisions', 'zilas'));
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
            'name' => 'required|string|unique:upazilas,name,'.$id,
            'division_id' => 'required',
            'zila_id' => 'required'
        ]);

        $upazila = Upazila::findOrFail($id);

        $upazila->division_id = $request->division_id;
        $upazila->zila_id = $request->zila_id;
        $upazila->name = $request->name;
        $upazila->slug = Str::slug($request->name);
        $upazila->status =$request->filled('status');
        $upazila->creator = Auth::user()->role->name;
        $upazila->save();

        Toastr::success('Successfully Upazila Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.upazilas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.upazilas.destroy');
        $upazila = Upazila::findOrFail($id);
        if ($upazila) {
            $upazila->delete();
            Toastr::success('Successfully Upazila Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.upazilas.index');
    }

    public function upazilaList(Request $request)
    {
        if ($request->ajax()) {
            if ($request->zila_id) {
                $output = '<option value="">Select Please</option>';
                $upazilas = Upazila::where('zila_id', $request->zila_id)->orderBy('id', 'asc')->get();
                if (!$upazilas->isEmpty()) {
                    foreach ($upazilas as $value) {
                        $output .= '<option value="' . $value->id . '">' . $value->name . '</option>';
                    }
                }
                return response()->json($output);
            }
        }
    }
}
