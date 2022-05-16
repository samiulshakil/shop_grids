<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\SubCategories\SubCategoryStoreFormRequest;
use App\Http\Requests\SubCategories\SubCategoryUpdateFormRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.subcategories.index');
        $sub_categories = SubCategory::with('category')->get();
        return view('backend.pages.subcategories.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.subcategories.create');
        $categories= Category::all();
        return view('backend.pages.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStoreFormRequest $request)
    {
        $data = SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => Str::slug($request->sub_category_name),
            'sub_category_creator' =>Auth::user()->role->name,
            'sub_category_status' =>$request->filled('sub_category_status'),
        ]);

        Toastr::success('Successfully Sub Category Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.subcategories.index');
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
        Gate::authorize('admin.subcategories.edit');
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('backend.pages.subcategories.edit',compact('categories','sub_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryUpdateFormRequest $request, $id)
    {
        $sub_category = SubCategory::findOrFail($id);
        
        $sub_category->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => Str::slug($request->sub_category_name),
            'sub_category_creator' => Auth::user()->role->name,
            'sub_category_status' => $request->filled('sub_category_status'),
        ]);

        Toastr::success('Successfully Sub Category Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.subcategories.destroy');
        $sub_category = SubCategory::findOrFail($id);
        if ($sub_category) {
            $sub_category->delete();
            Toastr::success('Successfully Category Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.subcategories.index');
    }
}
