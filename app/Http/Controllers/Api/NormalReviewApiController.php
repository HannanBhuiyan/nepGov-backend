<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\NormalOption;
use App\Models\NormalReview;
use App\Models\NormalVoting;
use Illuminate\Http\Request;
use App\Models\PollingNormal;
use App\Models\PollingCategory;
use App\Models\NormalVotingCount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        
        $normals = NormalVoting::latest()->get();
        return response()->json($normals);
    }

    public function single_normal_voting($topic){
        $single_normal_voting = NormalVoting::where('topic',$topic)->first();
        return response()->json($single_normal_voting);
    }

    public function normal_topic($categorySlug){
      
        if($categorySlug){
            $polling =   PollingCategory::where('slug', $categorySlug)->first();
            if($polling){
                $single_normal_topic = NormalVoting::where('category_id', $polling->id)->get();

                return response()->json($single_normal_topic);
            }else{
                return response()->json(["message" => "category doesn't exist"]);
            }
        }
      
    }

    // $single_normal_topiccc->category->category_name


    public function normalTopicPost(Request $request){
        
        $datas = $request->except('_token'); 

        foreach($datas as $key=>$value){ 
            NormalVotingCount::insert([
              'topic_id' => $value["topic_id"],
              'status' => $value["status"], 
              'created_at' => Carbon::now(),
            ]);
        }
        

        $ss = DB::table('normal_voting_counts')->get();
        $asd = collect($ss)->groupBy("topic_id");

        foreach($asd as $key=>$bsd){
            $result = DB::table('normal_voting_counts') 
            ->select(DB::raw('count(*) as count, status'))
            ->where('topic_id',$key)
            ->whereMonth('created_at',Carbon::today()->month)
            ->groupBy('status')
            ->get(); 
            foreach($result as $res){
                if($res->status == 0) {
                    $normalVote = NormalVoting::where('id',$key)->first('option_one_count');
                    $option_one = json_decode($normalVote->option_one_count);
                    $k =[...$option_one];
                        if(isset($k[Carbon::today()->month-1])){
                            $k[Carbon::today()->month-1]=$result[1]->count ?? 0;
                            NormalVoting::where('id',$key)->update([ 
                                "option_one_count"=>json_encode($k)
                            ]);
                        }else{
                            $value = [$result[1]->count ?? 0];
                            $option_one_append =[...$option_one,...$value];
                            NormalVoting::where('id',$key)->update([ 
                                "option_one_count"=>json_encode($option_one_append)
                            ]);
                        }
                } 

                else if($res->status == 1) {
                    $normalVote = NormalVoting::where('id',$key)->first('option_two_count');
                    $option_two = json_decode($normalVote->option_two_count);
                    $k =[...$option_two];
                        if(isset($k[Carbon::today()->month-1])){
                            $k[Carbon::today()->month-1]=$result[0]->count ?? 0;
                            NormalVoting::where('id',$key)->update([ 
                                "option_two_count"=>json_encode($k)
                            ]);
                        }else{
                            $value = [$result[0]->count ?? 0];
                            $option_two_append =[...$option_two,...$value];
                            NormalVoting::where('id',$key)->update([ 
                                "option_two_count"=>json_encode($option_two_append)
                            ]);
                        }
                }
            }
    }
        $data = [
            "msg"=> "Successfully submited data",
            "status"=>200
        ];
        return response()->json($data);
    }
   
}
