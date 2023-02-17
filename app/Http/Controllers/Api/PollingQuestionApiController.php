<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Models\PollingQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PollingQuestionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = PollingQuestion::all();
        return response()->json($questions);
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
        
        // $rules = array(
        //     'polling_category_id' => 'required',
        //     'question' => 'required',
        //     'slug' => 'required'
        // );
        // $valiodator = Validator::make($request->all(), $rules);
        // if($valiodator->fails()){
        //     return response()->json($valiodator->errors(),401);
        // }else{
        //     $cat = new PollingQuestion();
        //     $cat->polling_category_id = $request->polling_category_id;
        //     $cat->slug = $request->slug;
        //     $cat->question = $request->question;
    
        //     $cat->save();
        //     return response()->json(['status'=>200, 'success'=>'Question Create Success']);
        // }

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
        $cat = PollingQuestion::findOrFail($id);
        
        $rules = array(
            'polling_category_id' => 'required',
            'question' => 'required'
        );
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $cat->polling_category_id = $request->polling_category_id;
            $cat->question = $request->question;
    
            $cat->save();
            return response()->json(['status'=>200, 'success'=>'Question Update Success']);

        }
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
}
