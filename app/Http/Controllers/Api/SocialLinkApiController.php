<?php

namespace App\Http\Controllers\Api;

use App\Models\SocialLinks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SocialLinkApiController extends Controller
{
    public function index()
    {
        $items = SocialLinks::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {
        $rules = array(
            "facebook" => 'nullable|url',
            "twitter" => 'nullable|url',
            "instagram" => 'nullable|url',
            "linkedin" => 'nullable|url',
            "youtube" => 'nullable|url',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $socialurl = SocialLinks::findOrFail($id);
            $socialurl->facebook = $request->facebook;
            $socialurl->twitter = $request->twitter;
            $socialurl->instagram = $request->instagram;
            $socialurl->linkedin = $request->linkedin;
            $socialurl->youtube = $request->youtube;
            $socialurl->save();

            return response()->json(['status'=>200,'success'=> 'Social Link update success']);
        }
    }

    public function destroy($id)
    {

    }
}
