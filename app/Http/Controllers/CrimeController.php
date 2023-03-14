<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use App\Models\CrimeQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crimes = Crime::latest()->get();
        return view('layouts.backend.crime.crime-index', compact('crimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.crime.crime-create');
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
        ],[
            'crime_type.required' => 'Crime Type is Required',
            'crime_place.required' => 'Crime Place is Required',
            'is_heppened.required' => 'Happened Time is Required',
            'crime_details.required' => 'Crime Details is Required',
            'criminal_details.required' => 'Criminal Details is Required',
            'criminal_look_like.required' => 'Criminal look LIke is Required',
            'criminal_contact_details.required' => 'Criminal Contact Details is Required',
            'has_vehicle.required' => 'Has Vehicle is Required',
            'has_weapon.required' => 'Has Weapon is Required',
            'keep_user_in_contact.required' => 'Keep User in Contact is Required',
            'agreement.required' => 'Agreement is Required',
        ]);
       


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
        $crime->user_id = Auth::id() ?? 1;
        $crime->keep_user_in_contact = $request->keep_user_in_contact;
        $crime->agreement = $request->agreement == 'on' ? 1 : 0;
        $crime->has_weapon = $request->has_weapon;
        // $crime->extra_info = json_encode($request->extra_info);

        $crime->save();
        
        return redirect()->route('crime.index')->with('success', 'Crime create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $crime = Crime::findOrFail($id);
        return view('layouts.backend.crime.crime-show', compact('crime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crime = Crime::findOrFail($id);
        return view('layouts.backend.crime.crime-edit', compact('crime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
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
        ],[
            'crime_type.required' => 'Crime Type is Required',
            'crime_place.required' => 'Crime Place is Required',
            'is_heppened.required' => 'Happened Time is Required',
            'crime_details.required' => 'Crime Details is Required',
            'criminal_details.required' => 'Criminal Details is Required',
            'criminal_look_like.required' => 'Criminal look LIke is Required',
            'criminal_contact_details.required' => 'Criminal Contact Details is Required',
            'has_vehicle.required' => 'Has Vehicle is Required',
            'has_weapon.required' => 'Has Weapon is Required',
            'keep_user_in_contact.required' => 'Keep User in Contact is Required',
            'agreement.required' => 'Agreement is Required',
        ]);

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
        $crime->user_id = Auth::id() ?? 1;
        $crime->keep_user_in_contact = $request->keep_user_in_contact;
        $crime->agreement = $request->agreement == 'on' ? 1 : 0;
        

        $crime->save();
        return redirect()->route('crime.index')->with('success', 'Crime update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Crime::findOrFail($id)->delete();
        return redirect()->route('crime.index')->with('fail', 'Crime delete success');
    }
}
