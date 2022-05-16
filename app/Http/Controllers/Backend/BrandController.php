<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Brands\BrandFormRequest;
use App\Http\Requests\Brands\UpdateFormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.brands.index');
        $brands = Brand::all();
        return view('backend.pages.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.brands.create');
        return view('backend.pages.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandFormRequest $request)
    {
        $data = Brand::create([
            'brand_name' => $request->brand_name,
            'brand_slug' => Str::slug($request->brand_name),
            'brand_image' => $request->brand_image,
            'brand_creator' =>Auth::user()->role->name,
            'brand_status' =>$request->filled('brand_status'),
        ]);

        if ($request->hasfile('brand_image')) {
            $image = $request->file('brand_image');
            $fileName = 'brands-'. rand() .'.' .$image->extension('brand_image');
            $upload_path = 'uploads/brands/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $data->brand_image = $img_url;
            $data->save();
        }

        Toastr::success('Successfully Brands Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.brands.index');
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
        Gate::authorize('admin.brands.edit');
        $brand = Brand::findOrFail($id);
        return view('backend.pages.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormRequest $request, $id)
    {
        $brand = Brand::find($id);
        if ($request->hasfile('brand_image')) {
            if ($brand->brand_image != NULL) {
                unlink($brand->brand_image);
            }
            $image = $request->file('brand_image');
            $fileName = 'brands-'. rand() .'.' .$image->extension('brand_image');
            $upload_path = 'uploads/brands/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $brand->brand_image = $img_url;
        }

        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);
        $brand->brand_status =$request->filled('brand_status');
        $brand->brand_creator = Auth::user()->role->name;
        $brand->save();

        Toastr::success('Successfully Brands Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.brands.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.brands.destroy');
        $brand = Brand::find($id);
        if ($brand) {
            $image = $brand->brand_image;
            if ($image != NULL) {
                unlink($image);
            }
            $brand->delete();
            Toastr::success('Successfully Brand Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.brands.index');
    }
}
