<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\MultiImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon; 
use App\Http\Requests\Products\StoreFormRequest;
use App\Http\Requests\Products\UpdateFormRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.products.index');
        $products = Product::with(['category', 'brand', 'subcategory', 'user'])->get();
        return view('backend.pages.products.index', compact('products'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin.products.create');
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.pages.products.create', compact('categories','brands'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
    {
        $product = Product::create([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'user_id' => Auth::id(),
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'product_thumbnail' => $request->product_thumbnail,
            'image_one' => $request->image_one,
            'image_two' => $request->image_two,
            'image_three' => $request->image_three,
            'short_description' => $request->short_description,
            'long_description'=> $request->long_description,
            'key_features' => $request->key_features,
            'specifications' => $request->specifications,
            'hot_deals' => $request->filled('hot_deals'),
            'featured' => $request->filled('featured'),
            'special_offer' => $request->filled('special_offer'),
            'special_deals' => $request->filled('special_deals'),
            'product_creator' => Auth::user()->role->name,
            'product_status' => $request->filled('product_status'),
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasfile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $fileName = 'products-'. rand() .'.' .$image->extension('product_thumbnail');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $product->product_thumbnail = $img_url;
            $product->save();
        }

        if ($request->hasfile('image_one')) {
            $image_one = $request->file('image_one');
            $fileName = 'products-'. rand() .'.' .$image_one->extension('image_one');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image_one->move($upload_path, $fileName);
            $product->image_one = $img_url;
            $product->save();
        }

        if ($request->hasfile('image_two')) {
            $image_two = $request->file('image_two');
            $fileName = 'products-'. rand() .'.' .$image_two->extension('product_thumbnail');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image_two->move($upload_path, $fileName);
            $product->image_two = $img_url;
            $product->save();
        }

        if ($request->hasfile('image_three')) {
            $image_three = $request->file('image_three');
            $fileName = 'products-'. rand() .'.' .$image_three->extension('image_three');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image_three->move($upload_path, $fileName);
            $product->image_three = $img_url;
            $product->save();
        }


        Toastr::success('Successfully Product Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.products.index');
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
    public function edit($slug)
    {
        Gate::authorize('admin.products.edit');
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::where('product_slug', $slug)->firstOrFail();
        return view('backend.pages.products.edit', compact('categories','brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormRequest $request)
    {
        $id = $request->id;
        $old_img = $request->old_img;
        $old_one = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;
        $product = Product::where('id', $id)->firstOrFail();

        $product->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'user_id' => Auth::id(),
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price, 
            'short_description' => $request->short_description,
            'long_description'=> $request->long_description,
            'key_features' => $request->key_features,
            'specifications' => $request->specifications,
            'hot_deals' => $request->filled('hot_deals'),
            'featured' => $request->filled('featured'),
            'special_offer' => $request->filled('special_offer'),
            'special_deals' => $request->filled('special_deals'),
            'product_creator' => Auth::user()->role->name,
            'product_status' => $request->filled('product_status'),
            'updated_at' => Carbon::now(),
        ]);

        if ($request->hasfile('product_thumbnail')) {
            unlink($old_img);
            $image = $request->file('product_thumbnail');
            $fileName = 'products-'. rand() .'.' .$image->extension('product_thumbnail');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $product->product_thumbnail = $img_url;
            $product->save();
        }

        if ($request->hasfile('image_one')) {
            unlink($old_one);
            $image_one = $request->file('image_one');
            $fileName = 'products-'. rand() .'.' .$image_one->extension('image_one');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image_one->move($upload_path, $fileName);
            $product->image_one = $img_url;
            $product->save();
        }

        if ($request->hasfile('image_two')) {
            unlink($old_two);
            $image_two = $request->file('image_two');
            $fileName = 'products-'. rand() .'.' .$image_two->extension('image_two');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image_two->move($upload_path, $fileName);
            $product->image_two = $img_url;
            $product->save();
        }

        if ($request->hasfile('image_three')) {
            unlink($old_three);
            $image_three = $request->file('image_three');
            $fileName = 'products-'. rand() .'.' .$image_three->extension('image_three');
            $upload_path = 'uploads/products/thumbnail/';
            $img_url = $upload_path.$fileName;
            $image_three->move($upload_path, $fileName);
            $product->image_three = $img_url;
            $product->save();
        }

        Toastr::success('Successfully Product Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('admin.products.destroy');
        $product = Product::findOrFail($id);
        $thumbnail = $product->product_thumbnail;
        $one = $product->image_one;
        $two = $product->image_two;
        $three = $product->image_three;

        if ($product) {
            unlink($thumbnail);
            unlink($one);
            unlink($two);
            unlink($three);
            $product->delete();
            Toastr::success('Successfully Product Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.products.index');
    }

    public function active($slug){
        $product = Product::where('product_slug', $slug)->firstOrFail();
        $product->update([
            'product_status' => 1,
        ]);
        Toastr::success('Successfully Product Active', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.products.index');
    }

    public function inactive($slug){
        $product = Product::where('product_slug', $slug)->firstOrFail();
        $product->update([
            'product_status' => 0,
        ]);
        Toastr::success('Successfully Product Inactive', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.products.index');
    }

    public function subCategoryList(Request $request)
    {
        if ($request->ajax()) {
            if ($request->category_id) {
                $output = '<option value="">Select Please</option>';
                $sub_categories = SubCategory::where('category_id', $request->category_id)->orderBy('id', 'asc')->get();
                if (!$sub_categories->isEmpty()) {
                    foreach ($sub_categories as $value) {
                        $output .= '<option value="' . $value->id . '">' . $value->sub_category_name . '</option>';
                    }
                }
                return response()->json($output);
            }
        }
    }
}
