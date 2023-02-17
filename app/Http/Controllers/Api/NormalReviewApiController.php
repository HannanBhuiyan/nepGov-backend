<?php

namespace App\Http\Controllers\Api;

use App\Models\NormalReview;
use Illuminate\Http\Request;
use App\Models\PollingNormal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\NormalOption;
use App\Models\NormalVoting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NormalReviewApiController extends Controller
{
    public function store(Request $request)
    {

        $MAC = exec('getmac'); 
        $MAC = strtok($MAC, ' '); 

        $rules = array(
            'topic_id' => 'required',
            'option_id' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $review = new NormalReview();

            // $review->user_id = 1;
            $review->user_id = Auth::id();
            $review->topic_id = $request->topic_id;
            $review->option_id = $request->option_id;
            $review->ip_address = $request->ip();
            $review->mac_id = $MAC;
            $review->save();
            $review_id = $review->id;
            // return response()->json([
            //     'status'=>200, 
            //     "message" => "Thanks for your vote!"
            // ]);

            return $this->abc($review_id);
        }
    }
    
    public function abc($id){
        
        $topic_id=NormalReview::findOrFail($id)->topic_id;
        $aaa=NormalReview::where('topic_id',$topic_id)->with('normal_options')->get();
        $result = DB::table('normal_reviews') 
            ->select(DB::raw('count(*) as count, option_id'))
            ->where('topic_id', '=', $topic_id)
            ->groupBy('option_id')
            ->get();
            $cou = $aaa->count(); 
        return response()->json(["total_count" => $cou, "topic_id" => $topic_id, "data" => $result, "aaa"=> $aaa ]);
    }

    public function index(){

        return response([
            'topic_name' => 'science',
            'approved' => 200,
            'disapproved' => 100
        ]);

    }

    public function all_normal_voting(){
        // return 'ok';
        $normals = NormalVoting::latest()->get();
        return response()->json($normals);
    }

    public function single_normal_voting($topic){
        $single_normal_voting = NormalVoting::where('topic',$topic)->first();
        return response()->json($single_normal_voting);
    }

    public function normal_topic($slug){
        $single_normal_topic = NormalVoting::where('slug',$slug)->first();
        // $results = NormalOption::where('topic_id', $single_normal_topic->id)->get();

        // return $sss = $results->map(function($result,$index){
        //     $options = DB::table('normal_options')
        //     ->groupBy('option_id')
        //     ->get();

        //     $arr = array(
        //         "optionsData"=> $options,
        //         'totalCount' =>$result->count 
        //     );
 
        //     return $arr;
        // });
        return response()->json($single_normal_topic);
    }

    public function normalTopicPost(Request $request){
        return $request->all();
    }
}
