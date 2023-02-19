<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Crime;
use App\Mail\EmailOffer;
use App\Models\NormalReview;
use Illuminate\Http\Request;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\PollingReview;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return $token = rand(100000, 999999);
        
        $total_users  = [];
        $total_news   = [];
        
        for ($i=1; $i <=12 ; $i++) {
            $total_users []  = User::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
            $total_news []   = News::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
        }

        $normal_reviews  = [];
        $polling_reviews   = [];
        
        for ($i=1; $i <=12 ; $i++) {
            $normal_reviews []  = PollingReview::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
            $polling_reviews []   = NormalReview::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
        }
        
        $last_30_days_users = User::where('created_at','>=',Carbon::now()->subdays(30))->get();
        $last_7_days_users = User::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_30_days_news = News::where('created_at','>=',Carbon::now()->subdays(30))->get();
        $last_7_days_news = News::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_7_days_live = PollingReview::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_7_days_normal = NormalReview::where('created_at','>=',Carbon::now()->subdays(7))->get();
        $last_30_days_crime = Crime::where('created_at','>=',Carbon::now()->subdays(30))->get();
        $last_7_days_crime = Crime::where('created_at','>=',Carbon::now()->subdays(7))->get();

        $users = User::all();
        $news = News::all();
        $crimes = Crime::all();
        $live_rev = PollingReview::all();
        $normal_rev = NormalReview::all();
        return view('home',compact('users','news','crimes','total_users','total_news','last_30_days_users','last_7_days_users','normal_reviews','polling_reviews','last_7_days_news','last_30_days_news','last_7_days_live','last_7_days_normal','live_rev','normal_rev','last_30_days_crime','last_7_days_crime'));
    }

    public function users_list()
    {
        $user_groups = UserGroup::all();
        $users = User::all();
        $categories = PollingCategory::all();
        return view('layouts.backend.user_list',compact('users','user_groups', 'categories'));
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('fail', 'User delete success');
    }

    // public function multi_email_offer(Request $request)
    // {
       
    //     foreach ($request->check as $id) {
    //         Mail::to(User::find($id)->email)->send(new EmailOffer());
    //     }
    //     return back()->with('success','mail send success');
    // }
}
