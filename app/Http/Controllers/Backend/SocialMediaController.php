<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = SocialMedia::all();
        return view('backend.pages.settings.social_media.index', compact('socials'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.settings.social_media.create');
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
            'name' => 'required|string',
            'url' => 'required|string',
            'icon' => 'required|string',
        ]);

        SocialMedia::create([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'status' => $request->filled('status')
        ]);

        Toastr::success('Successfully Social Media Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.socialmedias.index');

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
        $social = SocialMedia::findOrFail($id);
        return view('backend.pages.settings.social_media.edit', compact('social'));
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
            'name' => 'required|string',
            'url' => 'required|string',
            'icon' => 'required|string',
        ]);

        $social = SocialMedia::findOrFail($id);

        $social->update([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'status' => $request->filled('status')
        ]);

        Toastr::success('Successfully Social Media Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.socialmedias.index');

    }

    public function active($id){
        Gate::authorize('admin.settings.socialmedias.index');
        $social = SocialMedia::where('id', $id)->firstOrFail();
        $social->update([
            'status' => 1,
        ]);
        Toastr::success('Successfully Social Active', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.socialmedias.index');
    }

    public function inactive($id){
        Gate::authorize('admin.settings.socialmedias.edit');
        $product = SocialMedia::where('id', $id)->firstOrFail();
        $product->update([
            'status' => 0,
        ]);
        Toastr::success('Successfully Social Inactive', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.socialmedias.index');
    }
}
