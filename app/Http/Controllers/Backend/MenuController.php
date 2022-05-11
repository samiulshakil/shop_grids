<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.menus.index');
        $menus = Menu::latest('id')->get();
        return view('backend.pages.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.menus.create');
        return view('backend.pages.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin.menus.create');
        $request->validate([
            'name' => 'required|string|unique:menus',
            'description' => 'nullable|string',
        ]);
        Menu::create([
            'name' => Str::slug($request->name),
            'description' => $request->description,
            'deletable' => true
        ]);
        Toastr::success('Successfully Menu Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.menus.index');
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
        Gate::authorize('admin.menus.create');
        $menu = Menu::find($id);
        return view('backend.pages.menus.edit', compact('menu'));
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
        Gate::authorize('admin.menus.edit');
        $request->validate([
            'name' => 'required|string|unique:menus,name,'.$id,
            'description' => 'nullable|string',
        ]);
        $menu = Menu::find($id);

        $menu->update([
            'name' => Str::slug($request->name),
            'description' => $request->description,
            'deletable' => true
        ]);
        Toastr::success('Successfully Menu Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.menus.destroy');

        $menu = Menu::find($id);
        
        if ($menu->deletable == true)
        {
            $menu->delete();
            Toastr::success('Successfully Menu Deleted', '', ["positionClass" => "toast-top-right"]);
        } else  {
            Toastr::warning('Sorry you can\'t delete system menu.', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }
}
