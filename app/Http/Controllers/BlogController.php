<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
