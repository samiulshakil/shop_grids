<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.pages.index');
        $pages = Page::latest('id')->get();
        return view('backend.pages.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.pages.create');
        return view('backend.pages.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin.pages.create');
        $request->validate([
            'name' => 'required|string|unique:pages',
            'body' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $page = Page::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), 
            'short_description' => $request->short_description,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->filled('status'),
        ]);

        if($request->hasFile('image')){
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        Toastr::success('Successfully Profile Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.pages.index');
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
        Gate::authorize('admin.pages.edit');
        $page = Page::find($id);
        return view('backend.pages.pages.edit', compact('page'));
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
        Gate::authorize('admin.pages.edit');
        $page = Page::find($id);
        $request->validate([
            'name' => 'required|string|unique:pages,name,'.$id,
            'body' => 'required|string',
            'image' => 'nullable|image',
        ]);
        $page->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), 
            'short_description' => $request->short_description,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->filled('status'),
        ]);

        if($request->hasFile('image')){
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        Toastr::success('Successfully Profile Updated', '', ["positionClass" => "toast-top-right"]);
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
        Gate::authorize('admin.pages.destroy');
        $page = Page::find($id);
        $page->delete();
        Toastr::success('Successfully Page Deleted', '', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
