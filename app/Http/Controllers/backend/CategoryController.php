<?php

namespace App\Http\Controllers\backend;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::latest()->get();
       return view('layouts.backend.category.category-index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.category.category-create');
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
            'title' => 'required|unique:categories',
            'slug' => 'required',
            'category_short_desc' => 'required',
        ],[
            'title.required' => 'Category title is required',
            'category_short_desc.required' => 'Category Short Description is required'
        ]);

        $category = new category();
        
        if($request->hasFile('category_image'))
        {
           $image      = $request->file('category_image');
           $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
           $location   = public_path('backend/uploads/category/');
           $image->move( $location, $filename);
           $category->category_image = $filename;
        }

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->category_short_desc = $request->category_short_desc;

        $category->save();
        return redirect()->route('category.index')->with('success', 'Category create success');

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
        $category = category::findOrFail($id);
        return view('layouts.backend.category.category-edit', compact('category'));
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
            'title' => 'required|unique:categories,title,'.$id,
            'slug' => 'required',
            'category_short_desc' => 'required',
        ],[
            'title.required' => 'Category title is required',
            'category_short_desc.required' => 'Category Short Description is required'
        ]);

        $category = category::findOrFail($id);
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->category_short_desc = $request->category_short_desc;

        if($request->hasFile('category_image'))
        {
           $image      = $request->file('category_image');
           $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
           $location   = public_path('backend/uploads/category/');
           $image->move( $location, $filename);
           $category->category_image = $filename;
        }

        $category->save();
        return redirect()->route('category.index')->with('success', 'Category update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $count =  News::where('category_id', $id)->count();
        if($count > 0){
            return back()->with('fail', 'news r available in this category, please delete those first');
        }else{
            category::findOrFail($id)->delete();
            return redirect()->route('category.index')->with('fail', 'Category delete success');
        }
    }

 
}
