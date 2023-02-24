<?php

namespace App\Http\Controllers\Api;

use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class WebsiteApiController extends Controller
{
    public function index()
    {
        $items = Website::all();
        return response()->json($items);
    }

    public function image_settings($image)
    {
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $location = 'backend/assets/uploads/settings/';
        $final_image = $location.$name_gen;
        Image::make($image)->save($final_image);
        return $final_image;
    }

    public function store(Request $request)
   {

   }

    public function show($id)
    {
        $items = Website::findOrFail($id);
        return response()->json($items);
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'favicon' => 'image',
            'logo_header' => 'image',
            'logo_footer' => 'image',
            'footer_about' => 'required'
        );

        $items = Website::findOrFail($id);

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            //For Favicon
            if($request->file('favicon')){
                unlink($items->favicon);
                $fav_image = $request->file('favicon');
                $fav_final_image = $this->image_settings($fav_image);
                $items->favicon = $fav_final_image ;
            }
    
            //For Header Logo
            if($request->file('logo_header')){
                unlink($items->logo_header);
                $header_image = $request->file('logo_header');
                $header_final_image = $this->image_settings($header_image);
                $items->logo_header =  $header_final_image;
            }
    
             //For Footer Logo
            if($request->file('logo_footer')){
                unlink($items->logo_footer);
                $footer_image = $request->file('logo_footer');
                $footer_final_image = $this->image_settings($footer_image);
                $items->logo_footer = $footer_final_image;
            }
    
            $items->seo_title = $request->seo_title;
            $items->seo_description = $request->seo_description;
            $items->seo_keywords = $request->seo_keywords;
            $items->footer_about = $request->footer_about;
            $items->save();

            return response()->json(['status'=>200,'success'=> 'Settings update success']);
        }


    }

    public function destroy($id)
    {
    
    }

}
