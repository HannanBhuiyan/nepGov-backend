<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Crime;
use App\Mail\EmailOffer;
use App\Models\UserGroup;
use App\Models\NormalReview;
use App\Models\NormalVoting;
use Illuminate\Http\Request;
use App\Models\PollingReview;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

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
        // return env('MAIL_USERNAME');
        // $path = base_path('.env');
        // $test = file_get_contents($path);

        // if (file_exists($path)) {
        // file_put_contents($path, str_replace('APP_ENV=local', 'APP_ENV=production', $test));
        // }

        // die;
        
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
            $polling_reviews []   = NormalVoting::whereYear('created_at',date('Y'))->whereMonth('created_at',$i)->count();
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
        $roles = Role::all();
        $user_groups = UserGroup::all();
        $users = User::latest()->paginate(10);
        $categories = PollingCategory::all();
        return view('layouts.backend.user_list' ,compact('users','user_groups', 'categories','roles'));
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('fail', 'User delete success');
    }

    public function download_users(Request $request)
    {
        $users = User::latest()->paginate(10);
        // return view('layouts.backend.download.users',compact('users'));
        $pdf = PDF::loadView('layouts.backend.download.users',compact('users'));
        return $pdf->download('users.pdf');
        // return back();
    }


    function fileDelete(){
        $file = resource_path('views/layouts/backend/xyz.blade.php');
        
        unlink($file);

    }


    
}


