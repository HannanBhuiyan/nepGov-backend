<?php

namespace App\Http\Controllers;

use App\Models\NormalVoting;
use Illuminate\Http\Request;
use App\Models\PollingNormal;
use App\Models\PollingCategory;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NormalVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NormalVoting  $normalVoting
     * @return \Illuminate\Http\Response
     */
    public function show(NormalVoting $normalVoting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NormalVoting  $normalVoting
     * @return \Illuminate\Http\Response
     */
    public function edit(NormalVoting $normalVoting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NormalVoting  $normalVoting
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NormalVoting  $normalVoting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NormalVoting::findOrFail($id)->delete();
        return back()->with('success', 'Normal Topic delete success');
    }
}
