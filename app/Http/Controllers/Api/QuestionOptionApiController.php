<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionOptionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = QuestionOption::all();
        return response()->json($options);
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
            'question_id' => 'required',
            'option' => 'required'
        );
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $cat = new QuestionOption();
            $cat->question_id = $request->question_id;
            $cat->option = $request->option;
    
            $cat->save();
            return response()->json(['status'=>200,'success'=> 'Option Create success']);


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
        $cat =  QuestionOption::findOrFail($id);

        $rules = array(
            'question_id' => 'required',
            'option' => 'required'
        );
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $cat->question_id = $request->question_id;
            $cat->option = $request->option;
    
            $cat->save();
            return response()->json(['status'=>200,'success'=> 'Option update success']);

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
        QuestionOption::findOrFail($id)->delete();
        return response()->json(['status'=>200,'success'=> 'Option delete success']);
    }
}
