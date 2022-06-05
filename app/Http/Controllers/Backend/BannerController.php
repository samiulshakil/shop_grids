<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('backend.pages.settings.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.settings.banners.create');
        return view('backend.pages.settings.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('admin.settings.banners.create');
        $request->validate([
            'banner_image' => 'required',
            'banner_image_two' => 'required',
            'banner_title' => 'required|string',
            'banner_sub_title' => 'required|string',
            'banner_description' => 'required|string',
            'banner_price' => 'required|string',
            'banner_button_text' => 'required',
        ]);

        $banner = Banner::create([
            'banner_image' => $request->banner_image,
            'banner_image_two' =>  $request->banner_image_two,
            'banner_title' =>  $request->banner_title,
            'banner_sub_title' =>  $request->banner_sub_title,
            'banner_description' =>  $request->banner_description,
            'banner_price' =>  $request->banner_price,
            'banner_button_text' =>  $request->banner_button_text,
            'status' =>  $request->filled('status'),
        ]);

        if ($request->hasfile('banner_image')) {
            $image = $request->file('banner_image');
            $fileName = 'banners-'. rand() .'.' .$image->extension('banner_image');
            $upload_path = 'uploads/banners/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $banner->banner_image = $img_url;
            $banner->save();
        }

        if ($request->hasfile('banner_image_two')) {
            $image = $request->file('banner_image_two');
            $fileName = 'banners-'. rand() .'.' .$image->extension('banner_image_two');
            $upload_path = 'uploads/banners/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $banner->banner_image_two = $img_url;
            $banner->save();
        }

        Toastr::success('Successfully Banner Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.banners.index');
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
        Gate::authorize('admin.settings.banners.edit');
        $banner = Banner::findOrFail($id);
        return view('backend.pages.settings.banners.edit', compact('banner'));
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
        Gate::authorize('admin.settings.banners.edit');
        $request->validate([
            'banner_image' => 'nullable',
            'banner_image_two' => 'nullable',
            'banner_title' => 'required|string',
            'banner_sub_title' => 'required|string',
            'banner_description' => 'required|string',
            'banner_price' => 'required|string',
            'banner_button_text' => 'required',
        ]);

        $banner = Banner::findOrFail($id);

        $banner->update([
            'banner_title' =>  $request->banner_title,
            'banner_sub_title' =>  $request->banner_sub_title,
            'banner_description' =>  $request->banner_description,
            'banner_price' =>  $request->banner_price,
            'banner_button_text' =>  $request->banner_button_text,
            'status' =>  $request->filled('status'),
        ]);

        if ($request->hasfile('banner_image')) {
            $image = $request->file('banner_image');
            $fileName = 'banners-'. rand() .'.' .$image->extension('banner_image');
            $upload_path = 'uploads/banners/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $banner->banner_image = $img_url;
            $banner->save();
        }

        if ($request->hasfile('banner_image_two')) {
            $image = $request->file('banner_image_two');
            $fileName = 'banners-'. rand() .'.' .$image->extension('banner_image_two');
            $upload_path = 'uploads/banners/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $banner->banner_image_two = $img_url;
            $banner->save();
        }

        Toastr::success('Successfully Banner Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.banners.index');
    }

    public function active($id){
        $banner = Banner::where('id', $id)->firstOrFail();
        $banner->update([
            'status' => 1,
        ]);
        Toastr::success('Successfully Banner Active', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.banners.index');
    }

    public function inactive($id){
        $banner = Banner::where('id', $id)->firstOrFail();
        $banner->update([
            'status' => 0,
        ]);
        Toastr::success('Successfully Banner Inactive', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.settings.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
