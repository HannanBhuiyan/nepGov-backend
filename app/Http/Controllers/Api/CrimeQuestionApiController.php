<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CrimeQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CrimeQuestionApiController extends Controller
{
    public function index()
    {
        $questions = CrimeQuestion::all();
        return response()->json($questions);
    }

    public function store(Request $request)
    {
       $rules = array(
            'crime_type' => 'required',
            'question' => 'required',
            'answer_type' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $ques = new CrimeQuestion();
            $ques->crime_type = $request->crime_type;
            $ques->question = $request->question;
            $ques->answer_type = $request->answer_type;
    
            $ques->save();
        }
        return response()->json(['status'=>200,'success'=>'Question create success']);
    }

    public function update(Request $request,  $id)
    {
        $ques = CrimeQuestion::findOrFail($id);
        
        $rules = array(
            'crime_type' => 'required',
            'question' => 'required',
            'answer_type' => 'required',
        );
        
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $ques->crime_type = $request->crime_type;
            $ques->question = $request->question;
            $ques->answer_type = $request->answer_type;
    
            $ques->save();
        }
        return response()->json(['status'=>200,'success'=>'Question Update success']);
    }

    public function delete($id)
    {
        
    }

}
