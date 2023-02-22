<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SurvayAnswer;
use App\Models\SurvayQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SurvayApiController extends Controller
{
    function survay_question_api()
    {
        // return 'ok';
        $survay = SurvayQuestion::with('survay_options')->get();
        // $survay = SurvayQuestion::all();
        // foreach($survay as $sur){
            // foreach($survay as $sss){
            //     echo $sss->survay_options;
            // }
        // }
        // print_r($survay->survay_options);
        // die;
        return response()->json(['questions' => $survay]);
    }

    function survay_answer_api()
    {
        $survay = SurvayAnswer::find(1);

        return response()->json($survay);
    }

    function survay_answer_store(Request $request)
    {
        
        // $rules = array(
        //     'why_you_joined_nepGov' => 'required',
        //     'which_political_party_do_you_support' => 'required',
        //     'what_is_your_ethnicity' => 'required',
        //     'highest_educational_qualification_you_have' => 'required',
        //     'your_concern_to_our_category' => 'required',
        // );

        // $valiodator = Validator::make($request->all(), $rules);
        // if($valiodator->fails()){
        //     return response()->json($valiodator->errors(),401);
        // }else{
            $survay = SurvayAnswer::find(1);
            $survay->why_you_joined_nepGov = $request->why_you_joined_nepGov;
            $survay->which_political_party_do_you_support = $request->which_political_party_do_you_support;
            $survay->what_is_your_ethnicity = $request->what_is_your_ethnicity;
            $survay->highest_educational_qualification_you_have = $request->highest_educational_qualification_you_have;
            $survay->your_concern_to_our_category = $request->your_concern_to_our_category;
            $survay->user_id = 1;
            // $survay->user_id = Auth::id();
            $survay->extra_questions = json_encode($request->extra_questions);
            
            $survay->save();
        // }
        
        return response()->json(['status'=>200, 'success'=>'Survay Answer Stored Success']);

    }
    
}
