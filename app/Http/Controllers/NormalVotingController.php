<?php

namespace App\Http\Controllers;

use App\Models\NormalVoting;
use App\Models\NormalVotingCount;
use Illuminate\Http\Request;
use App\Models\PollingNormal;
use App\Models\PollingCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NormalVotingController extends Controller
{
   
    public function index()
    {
        $normals  = NormalVoting::all();
        $polling_category = PollingCategory::all();
        return view('layouts.backend.normal_voting.normal_voting-index', compact('polling_category','normals'));
    }

   
    public function normalVotingByUser()
    {
        return 'ok';
        return view('layouts.backend.normal_voting.normal_voting-index');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'topic' => 'required',
            'slug' => 'required',
            'option_one' => 'required',
            'option_two' => 'required'
        ]); 

        $months = Carbon::today()->month;
        $count = [];
        for($i=1; $i<=$months; $i++){
            array_push($count,0);
        }
        $cat = new NormalVoting();
        $cat->category_id = $request->category_id;
        $cat->topic = $request->topic;
        $cat->slug = $request->slug;
        $cat->option_one = $request->option_one;
        $cat->option_one_count = json_encode($count);
        $cat->option_two = $request->option_two;
        $cat->option_two_count = json_encode($count);
        $cat->option_three = $request->option_three;
        $cat->save();

        return back()->with('success', 'Normal Topic create success');

        $users = User::all();

        foreach($users as $user){
            Mail::send('email.normalVoting', function($message) use($user){
                $message->to($user->email);
                $message->subject('Verify Code');
            });
        }

    }

   
    public function edit(NormalVoting $normalVoting)
    {
        //
    }

    
    public function update(Request $request,  $id)
    {
        // return $request;
        $normal = NormalVoting::findOrFail($id);
        
        $request->validate([
            'category_id' => 'required',
            'topic' => 'required',
            'option_one' => 'required',
            'option_two' => 'required'
        ]);
        
        $normal->category_id = $request->category_id;
        $normal->topic = $request->topic;
        $normal->option_one = $request->option_one;
        $normal->option_two = $request->option_two;
        $normal->option_three = $request->option_three;
        
        $normal->save();
       
        return back()->with('success', 'Normal Topic Update success');
    }

    
    public function destroy($id)
    {
        NormalVoting::findOrFail($id)->delete();
        return back()->with('success', 'Normal Topic delete success');
    }

      
    public function normalVotingByTest(Request $request, $slug)
    {
        $polling =   PollingCategory::where('slug',$slug)->first();
       
        $single_normal_topic = NormalVoting::where('category_id', $polling->id)->get();
        
        return view('normalVotingTest', compact('polling','single_normal_topic'));
    }

    public function normar_poling_post(Request $request)
    {   
         


        $datas = $request->except('_token');
    //  return $datas;
        foreach($datas as $key=>$value){ 
            // return $key;
            NormalVotingCount::insert([
              'topic_id' => $key,
              'status' => $value, 
              'created_at' => Carbon::now(),
            ]);
        }
        
        return back();
    }

    public function month_wise_voting_count()
    {

   
        // return Carbon::today()->month;
    //    return NormalVoting::whereMonth('created_at',Carbon::today()->month)->get();

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

           

            // print_r($res);
        }

        

        // return $asd;

          
        


//         SELECT cate_id, SUM(total_cost)
// FROM purchase            
// GROUP BY cate_id;


        // $user_info = DB::table('normal_voting_counts')
        //         ->select('topic_id', DB::raw('count(status) as Approve' ) )   
        //         ->Sum(Case When Upgraded = 1 Then 1 Else 0 End) As CountUpgraded
        //         ->get();

        // echo $user_info;


        // $data ->select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
        //    ->groupby('year','month')
        //    ->get();

 

        // foreach($user_info as $value){
        //     $disappcount = NormalVotingCount::where('topic_id', $value->topic_id)->where('status', 0)->count();
        //     echo $disappcount . "<br>";
        // }
 
    }

}
