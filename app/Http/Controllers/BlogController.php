<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

    }

    // public function __construct()
    // {
    //     $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Category::get();
        return view('theme.blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {

       $data=$request->validated();
        $image = $request->image;
        $new_image = time() . '-' . $image->getClientOriginalName();
        $image->StoreAs('blogs', $new_image, 'public');
        $data['image'] =  $new_image;
        $data['user_id'] = Auth::user()->id;
        blog::create($data);
        return back()->with('blogCreateStatus', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
         return view('theme.single-blog',compact('blog'));
    }
    
    public function myBlogs(){
        $blogs=Blog::where('user_id',Auth::user()->id)->paginate(10);
        return view('theme.blogs.my-blogs',compact('blogs'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            $categories = Category::get();
            return view('theme.blogs.edit', compact('categories', 'blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if (Auth::user()->id == $blog->user_id) {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete("blogs/" . $blog->image);
                $image = $request->image;
                $new_image = time() . '-' . $image->getClientOriginalName();
                $image->StoreAs('blogs', $new_image, 'public');
                $data['image'] = $new_image;
            }

            $blog->update($data);
            return back()->with('blogUpdateStatus', 'Blog Updated successfully.');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if(Auth::user()->id == $blog->user_id){
            Storage::disk('public')->delete("blogs/" . $blog->image);
            $blog->delete();
            return back()->with('blogDeleteStatus', 'Blog Deleted successfully.');
        }
    }
}
