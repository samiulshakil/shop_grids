<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;




class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.roles.index');
        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.roles.create');
        $modules = Module::all();
        return view('backend.pages.roles.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin.roles.create');
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions'),[]);
        Toastr::success('Successfully Role Added', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.roles.index');
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
        Gate::authorize('admin.roles.edit');
        $role = Role::find($id);
        $modules = Module::all();
        return view('backend.pages.roles.edit', compact('role','modules'));
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
        Gate::authorize('admin.roles.edit');
        $request->validate([
            'name' => 'required|unique:roles,name,'. $id,
            'permissions' => 'array',
            'permissions.*' => 'integer',
        ]);

        $role = Role::find($id);

        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        $role->permissions()->sync($request->input('permissions'));
        Toastr::success('Successfully Role Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.roles.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.roles.destroy');
        $role = Role::find($id);
        
        if($role->deletable == true){
            $role->delete();
            Toastr::success('Successfully Role Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('You can not delete system role', '', ["positionClass" => "toast-top-right"]);
        }
        return back();
    }
}
