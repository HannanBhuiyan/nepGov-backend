<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\PollingSubCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PollingReview;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PollingCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polling_category = PollingCategory::all();
        return response()->json($polling_category);
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
            'category_name' => 'required',
            'slug' => 'required'
        );
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $cat = new PollingCategory();
            $cat->category_name = $request->category_name;
            $cat->slug = $request->slug;
            $cat->status = $request->status;
            $cat->user_id = Auth::id();
            $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
            if($request->country == null){
                $cat->country = 'global';
            }else{
                $cat->country = json_encode($request->country);
            }
    
            $cat->save();
            return response()->json(['status'=>200, 'success'=>'Category Create Success']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function topic_wise_questions($slug)
    {
        $topic = PollingSubCategory::where('slug', $slug)->first();
        $topic_name = $topic->name;
        $ques = PollingQuestion::where('sub_category_id',$topic->id)->with("poll_options")->get();
        return response()->json(['sub_cat_name' => $topic_name, 'ques'=>$ques]);
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
        // $cat = PollingCategory::findOrFail($id);

        // $rules = array(
        //     'category_name' => 'required'
        // );

        // $valiodator = Validator::make($request->all(), $rules);
        // if($valiodator->fails()){
        //     return response()->json($valiodator->errors(),401);
        // }else{
        //     $cat->category_name = $request->category_name;
        //     $cat->status = $request->status;
        //     $cat->need_registration = $request->need_registration == 'on' ? 1 : 0;
            
        //     if($request->country == null){
        //         $cat->country = 'global';
        //     }else{
        //         $cat->country = json_encode($request->country);
        //     }
    
        //     $cat->save();
        //     return response()->json(['status'=>200, 'success'=>'Category Update Success']);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function all_topics()
    {
        $all_topics = PollingSubCategory::latest()->get();

        return response()->json(['data'=>$all_topics]);
    }
}
