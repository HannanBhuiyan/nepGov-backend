<?php

namespace App\Http\Controllers\Api;

use App\Models\Crime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CrimeQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CrimeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crimes = Crime::all();
        return response()->json($crimes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->extra_info;
        // return $req = json_decode($request->extra_info,true);

        $rules = array (
            'crime_type' => 'required',
            'crime_place' => 'required',
            'is_heppened' => 'required',
            'crime_details' => 'required',
            'criminal_details' => 'required',
            'criminal_look_like' => 'required',
            'criminal_contact_details' => 'required',
            'has_vehicle' => 'required',
            'has_weapon' => 'required',
            'keep_user_in_contact' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{

            $crime = new Crime();
            $crime->crime_type = $request->crime_type;
            $crime->crime_place = $request->crime_place;
            $crime->crime_address_details = $request->crime_address_details;
            $crime->is_heppened = $request->is_heppened;
            $crime->heppened_time = $request->heppened_time;
            $crime->crime_details = $request->crime_details;
            $crime->criminal_details = $request->criminal_details;
            $crime->criminal_look_like = $request->criminal_look_like;
            $crime->criminal_contact_details = $request->criminal_contact_details;
            $crime->has_vehicle = $request->has_vehicle;
            $crime->has_weapon = $request->has_weapon;
            // $crime->user_id = 1;
            $crime->user_id = Auth::id();
            $crime->keep_user_in_contact = $request->keep_user_in_contact;
            $crime->agreement = $request->agreement == 'on' ? 1 : 0;
            $crime->extra_info = json_encode($request->extra_info);
            
            $crime->save();
            
            return response()->json(['status'=>200, 'success'=>'Crime Create Success']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crime = Crime::findOrFail($id);
        return response()->json($crime);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $crime = Crime::findOrFail($id);

        $rules = array(
            'crime_type' => 'required',
            'crime_place' => 'required',
            'is_heppened' => 'required',
            'crime_details' => 'required',
            'criminal_details' => 'required',
            'criminal_look_like' => 'required',
            'criminal_contact_details' => 'required',
            'has_vehicle' => 'required',
            'has_weapon' => 'required',
            'keep_user_in_contact' => 'required',
            'agreement' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $crime = Crime::findOrFail($id);
            $crime->crime_type = $request->crime_type;
            $crime->crime_place = $request->crime_place;
            $crime->crime_address_details = $request->crime_address_details;
            $crime->is_heppened = $request->is_heppened;
            $crime->heppened_time = $request->heppened_time;
            $crime->crime_details = $request->crime_details;
            $crime->criminal_details = $request->criminal_details;
            $crime->criminal_look_like = $request->criminal_look_like;
            $crime->criminal_contact_details = $request->criminal_contact_details;
            $crime->has_vehicle = $request->has_vehicle;
            $crime->has_weapon = $request->has_weapon;
            $crime->user_id = Auth::id();
            $crime->keep_user_in_contact = $request->keep_user_in_contact;
            $crime->agreement = $request->agreement == 'on' ? 1 : 0;
            
            $crime->save();
            return response()->json(['status'=>200, 'success'=>'Crime Update Success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    }
}
