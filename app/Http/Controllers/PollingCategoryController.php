<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PollingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $users  = User::latest()->get();
        $polling_category = PollingCategory::latest()->get();
        return view('layouts.backend.polling_category.polling_category-index', compact('polling_category','users','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $countries = Country::all();
        return view('layouts.backend.polling_category.polling_category-create');
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
            'category_name' => 'required',
            'slug' => 'required'
        ]);

        $cat = new PollingCategory();
        $cat->category_name = $request->category_name;
        $cat->slug = $request->slug;
        $cat->user_id = Auth::id();

        $cat->save();
        return redirect()->route('polling_category.index')->with('success', 'Category create success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingCategory  $pollingCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $polling_category = PollingCategory::findOrFail($id);
        $countries = Country::all();
        return view('layouts.backend.polling_category.polling_category-edit',compact('countries','polling_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingCategory  $pollingCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat = PollingCategory::findOrFail($id);

        $request->validate([
            'category_name' => 'required'
        ]);

        $cat->category_name = $request->category_name;
        $cat->save();

        return redirect()->route('polling_category.index')->with('success', 'Category Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingCategory  $pollingCategory
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $count =  PollingQuestion::where('polling_category_id', $id)->count();
        if($count > 0){
            return back()->with('fail', 'questions r available in this category, please delete those first');
        }else{
            PollingCategory::findOrFail($id)->delete();
            return redirect()->route('polling_category.index')->with('success', 'Category delete success');
        }       
    }


}
