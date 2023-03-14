<?php

namespace App\Http\Controllers;

use App\Mail\EmailOffer;
use App\Models\GroupUser;
use App\Models\UserGroup;
use App\Models\AssignGroup;
use App\Models\PollingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GroupUserController extends Controller
{
    public function create_new_group(Request $request)
    {
        $request->validate([
            'group_name' => 'required',
        ]);
        UserGroup::create([
            'group_name' => $request->group_name
        ]);

        return back()->with('success', 'Group Created');
    }

    public function assign_users_group(Request $request)
    { 
        // return $request;
        $request->validate([
            'check' => 'required',
            'group_id' => 'required',
            'category_id' => 'required'
        ],[
            'check.required' => 'Please Select Some Users',
            'group_id.required' => 'Please Select  a Group',
            'category_id.required' => 'Please Select a Category',
        ]);

        foreach($request->check as $user_id){
           $data = AssignGroup::where('group_id', $request->group_id)->where('user_id', $user_id)->exists();
            if($data){
                return redirect()->back()->with("fail", 'User already assigned in this group');
            } 
        }
  
        foreach ($request->check as $user_id) {
            AssignGroup::insert([
                'user_id' => $user_id,
                'group_id' => $request->group_id,
                'category_id' => $request->category_id,
            ]);
        }
        
        return back()->with('success', 'Group Assigned');
    }

    public function group_users()
    {
        $groups = UserGroup::latest()->get(); 
        $assign_users = AssignGroup::all();
        $assign_user = [];
        return view('layouts.backend.user_group', compact('groups', 'assign_users','assign_user'));
    }


    public function groupwiseuser(Request $request){

        $assign_user = AssignGroup::where('group_id', $request->data_id)->get();
 
        $view = view('layouts.backend.group_users',compact('assign_user'))->render();

        return response()->json(['data'=>$view ]);
    }
    

   
    public function sendMailToUsers(Request $request)
    {
 
        // return $request->allEmails;
        $request->validate([
            'allEmails' => 'required'
        ],[
            'allEmails.required' => 'Please Select a Group with Users First'
        ]);

        foreach($request->allEmails as $email){
            Mail::to($email)->send(new EmailOffer($request->slug));
        }
        return back()->with('success','mail sent');
        return response()->json(['success'=>'Mail Sent']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return \Illuminate\Http\Response
     */
    public function groupUserDelete(Request $request)
    {
        // return $request->group_id;
        $user_group = UserGroup::find($request->group_id);
        $assign_users = AssignGroup::where('group_id',$request->group_id)->get();
        foreach($assign_users as $assign){
            $assign->delete();
        }

        $user_group->delete();

        return response()->json(['status'=>200, 'message'=>'Group Deleted']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupUser  $groupUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignGroup $groupUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignGroup $groupUser)
    {
    
    }
}
