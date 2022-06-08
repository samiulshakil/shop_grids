<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with('category')->where('status', 1)->orderBy('created_at')->take(3)->get();
        return view('backend.pages.blogs.index', compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        return view('backend.pages.blogs.create', compact('categories'));
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
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'minute_read' => 'required|string',
            'image' => 'required|image',
            'category_id' => 'required',
            'author' => 'required',
            'tags' => 'required',
            'hash_tags' => 'required',
        ]);

        $blogs = Blog::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'minute_read' => $request->minute_read,
            'image' => $request->image,
            'status' => $request->filled('status'),
            'category_id' => $request->category_id,
            'author' => $request->author,
            'tags' => $request->tags,
            'hash_tags' => $request->hash_tags,
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $fileName = 'blogs-'. rand() .'.' .$image->extension('image');
            $upload_path = 'uploads/blogs/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $blogs->image = $img_url;
            $blogs->save();
        }

        Toastr::success('Successfully Blog Created', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.blogs.index');
        

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
        $categories= Category::all();
        $blog = Blog::findOrFail($id);
        return view('backend.pages.blogs.edit', compact('blog', 'categories'));
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
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'description' => 'required|string',
            'minute_read' => 'required|string',
            'image' => 'nullable|image',
            'category_id' => 'required',
            'author' => 'required',
            'tags' => 'required',
            'hash_tags' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'minute_read' => $request->minute_read,
            'status' => $request->filled('status'),
            'category_id' => $request->category_id,
            'author' => $request->author,
            'tags' => $request->tags,
            'hash_tags' => $request->hash_tags,
        ]);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $fileName = 'blogs-'. rand() .'.' .$image->extension('image');
            $upload_path = 'uploads/blogs/';
            $img_url = $upload_path.$fileName;
            $image->move($upload_path, $fileName);
            $blog->image = $img_url;
            $blog->save();
        }

        Toastr::success('Successfully Blog Updated', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog) {
            $blog->delete();
            Toastr::success('Successfully Blog Deleted', '', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('No Row Found on database', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('admin.blogs.index');
    }
}
