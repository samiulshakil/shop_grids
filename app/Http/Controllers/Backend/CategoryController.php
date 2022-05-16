<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Categories\CategoryStoreFormRequest;
use App\Http\Requests\Categories\CategoryUpdateFormRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.categories.index');
        $categories = Category::all();
        return view('backend.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.categories.create');
        return view('backend.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreFormRequest $request)
    {
        $data = Category::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'category_image' => $request->category_image,
            'category_creator' =>Auth::user()->role->name,
            'category_status' =>$request->filled('category_status'),
        ]);

        if ($request->hasfile('category_image')) {
            $image = $request->file('category_image');
            $fileName = 'categories-'. rand() .'.' .$image->extension('category_image');
            $upload_path = 'uploads/categories/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $data->category_image = $img_url;
            $data->save();
        }

        Toastr::success('Successfully Category Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.categories.index');
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
        Gate::authorize('admin.categories.edit');
        $category = Category::findOrFail($id);
        return view('backend.pages.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateFormRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($request->hasfile('category_image')) {
            if ($category->category_image != NULL) {
                unlink($category->category_image);
            }
            $image = $request->file('category_image');
            $fileName = 'categories-'. rand() .'.' .$image->extension('category_image');
            $upload_path = 'uploads/categories/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $category->category_image = $img_url;
        }

        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        $category->category_status =$request->filled('category_status');
        $category->category_creator = Auth::user()->role->name;
        $category->save();

        Toastr::success('Successfully Category Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.categories.destroy');
        $category = Category::findOrFail($id);
        if ($category) {
            $image = $category->category_image;
            if ($image != NULL) {
                unlink($image);
            }
            $category->delete();
            Toastr::success('Successfully Category Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.categories.index');
    }
}
