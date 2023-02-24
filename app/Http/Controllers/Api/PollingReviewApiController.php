<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PollingReview;
use App\Http\Controllers\Controller;
use App\Models\PollingQuestion;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PollingReviewApiController extends Controller
{
    public function store(Request $request)
    {
        // return 'ok';
        // $MAC = exec('getmac'); 
        // $MAC = strtok($MAC, ' '); 

        $rules = array(
            'question_id' => 'required',
            'polling_option_id' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $review = new PollingReview();

            // $review->user_id = 1;
            $review->user_id = Auth::id();
            $review->question_id = $request->question_id;
            $review->polling_option_id = $request->polling_option_id;
            $review->ip_address = $request->ip();
            // $review->mac_id = $MAC;
            $review->save();

            $review_id = $review->id;
            $IP = $request->ip();
            return $this->abc($review_id, $IP);
        }
    }
    

    public function abc($id){

        $poll_que_id=PollingReview::findOrFail($id)->question_id;

        // $MAC = exec('getmac'); 
        // $MAC = strtok($MAC, ' '); 

        $options = QuestionOption::where('question_id',$poll_que_id)->get();

        $count=PollingReview::where('question_id',$poll_que_id)
        ->count();

        $result = DB::table('polling_reviews') 
            ->select(DB::raw('count(*) as count, polling_option_id'))
            ->where('question_id','=', $poll_que_id)
            ->groupBy('polling_option_id')
            ->get();

            $data= $options->map(function ($item, $key) use($result) {
                $single_agent = $result->where('polling_option_id',$item->id);
                return collect($item)->merge($single_agent);
            });
            
        return response()->json(["total_count" => $count, "question_id" => $poll_que_id, "data" => $data ]);
    }


    public function index(){
        $polling_review = PollingReview::all();
        return response()->json($polling_review);
    }


    public function polling_options(){
        $results = DB::table('polling_reviews') 
        ->select(DB::raw('count(*) as count, question_id'))
        ->groupBy('question_id')
        ->get();

        $sss = $results->map(function($result,$index){
            $options = DB::table('polling_reviews')
            ->select(DB::raw('count(*) as count, polling_option_id'))
            ->where('question_id', $result->question_id)
            ->groupBy('polling_option_id')
            ->get();

            $arr = array(
                "optionsData"=> $options,
                "question" =>$result->question_id,
                'totalCount' =>$result->count 
            );
 
            return $arr;
        });

        return response()->json(['data'=> $sss]);
    }
}
