<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{
    
   
    public function index()
    {
        $categories = category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required|unique:categories',
            'slug' => 'required',
            'category_short_desc' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{

            if($request->hasFile('category_image'))
            {
            $image      = $request->file('category_image');
            $filename   = uniqid() . '.' . $image->getClientOriginalExtension();
            $location   = public_path('backend/uploads/category/');
            $image->move( $location, $filename);
            }

            $category = new category();
            $category->title = $request->title;
            $category->slug = $request->slug;
            $category->category_short_desc = $request->category_short_desc;
            $category->category_image = $filename;

            $category->save();
            return response()->json(['status'=>200, 'success'=>'Category Create Success']);

        }

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
        //
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
        $category = category::findOrFail($id);

        $rules = array(
            'title' => 'required|unique:categories,title,'.$category->id,
            'slug' => 'required',
            'category_short_desc' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            
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
            return response()->json(['status'=>200, 'success'=>'Category Update Success']);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    
    }
}
