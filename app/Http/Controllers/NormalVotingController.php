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

        $cat = new NormalVoting();
        $cat->category_id = $request->category_id;
        $cat->topic = $request->topic;
        $cat->slug = $request->slug;
        $cat->option_one = $request->option_one;
        $cat->option_two = $request->option_two;
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

    public function normar_poling_post(Request $req)
    {   

        $datas = $req->except('_token');

        foreach($datas as $key=>$value){ 
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
        
        // $result = DB::table('normal_voting_counts') 
        // ->groupby('topic_id')
        // ->get();

        // $user_info = DB::table('normal_voting_counts', true) 
        // ->selectRaw("SUM(status) as total_debit")
        // ->selectRaw("SUM(CASE WHEN status=0) as total_credit")
        // ->groupBy('topic_id')
        // ->get();

        // echo $user_info;

        // ->sum('th_bill_amt')
        // ->groupBy('th_exp_cat_id')

        // 
    //    return NormalVoting::whereMonth('created_at',Carbon::today()->month)->get();

        $ss = DB::table('normal_voting_counts')->get();
        $asd =   collect($ss)->groupBy("topic_id");

        // $datas = [] ;
        // for ($i=1; $i <=12 ; $i++) {
        //     $datas  = NormalVotingCount::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
        //     echo $datas.'<br>';
        // }
        // die();

        //   $result = DB::table('normal_voting_counts') 
        //   ->select(DB::raw('count(*) as count, status'))
        //   ->where('topic_id',2)
        //   ->whereMonth('created_at',Carbon::today()->month)
        //   ->groupBy('status')
        //   ->get();
        //   return $result;
        // $result = DB::table('normal_voting_counts') 
        // ->select(DB::raw('count(*) as count, status'))
        // ->where('topic_id',2)
        // ->whereMonth('created_at',Carbon::today()->month)
        // ->groupBy('status')
        // ->get();


     

        foreach($asd as $key=>$bsd){
            $result = DB::table('normal_voting_counts') 
            ->select(DB::raw('count(*) as count, status'))
            ->where('topic_id',$key)
            ->whereMonth('created_at',Carbon::today()->month)
            ->groupBy('status')
            ->get(); 

            // for($i =1; $i <= 12; i++){

            // }


            foreach($result as $res){
                if($res->status == 0)
                {
                    $cs = [$result[1]->count ?? 0];
                    $asdss = [0, ...$cs];
                    NormalVoting::where('id',$key)->update([
                        "option_one_count"=> $asdss
                        ]);
                    }
                    else if($res->status == 1)
                {
                    $css = [$result[0]->count ?? 0];
                    $asdsss = [0, ...$css];
                    NormalVoting::where('id',$key)->update([ 
                        "option_two_count"=>$asdsss
                    ]);
                }
            }
        }


        // return $result;

          
        


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
