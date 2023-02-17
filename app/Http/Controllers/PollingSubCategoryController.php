<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\PollingSubCategory;
use Illuminate\Support\Facades\Auth;

class PollingSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.polling_sub_cat.polling_sub_cat-create',[
            'category' => PollingCategory::all(),
            'countries' => Country::all()
        ]);
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
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ]);

        $cat = new PollingSubCategory();
        $cat->category_id = $request->category_id;
        $cat->name = $request->name;
        $cat->slug = $request->slug;
        // $cat->status = $request->status;
        $cat->status = 'live';
        $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
        if($request->country == null){
            $cat->country = 'global';
        }else{
            $cat->country = json_encode($request->country);
        }

        $cat->save();
        // return back();
        return redirect()->route('polling_category.index')->with('success', 'Sub Category create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PollingSubCategory $pollingSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PollingSubCategory $pollingSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $cat = PollingSubCategory::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $cat->name = $request->name;
        $cat->status = 'live';
        $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
        
        if($request->country == null){
            $cat->country = 'global';
        }else{
            $cat->country = json_encode($request->country);
        }

        $cat->save();
        return redirect()->route('polling_category.index')->with('success', 'SubCategory Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingSubCategory  $pollingSubCategory
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $count =  PollingQuestion::where('sub_category_id', $id)->count();
        if($count > 0){
            return back()->with('fail', 'questions r available in this category, please delete those first');
        }else{
            PollingSubCategory::findOrFail($id)->delete();
            return redirect()->route('polling_category.index')->with('success', 'SubCategory delete success');
        } 
    }
}
