<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Website::first();
        return view('layouts.backend.website.website-index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('layouts.backend.website.website-create');
    }


    public function image_settings($image)
    {
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $location = 'backend/assets/uploads/settings/';
        $final_image = $location.$name_gen;
        Image::make($image)->save($final_image);
        return $final_image;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'favicon' => 'required|image',
        //     'logo_header' => 'required|image',
        //     'logo_footer' => 'required|image'

        // ]);
        // //For Favicon
        // $fav_image = $request->file('favicon');
        // $fav_final_image = $this->image_settings($fav_image);

        // //For Header Logo
        // $header_image = $request->file('logo_header');
        // $header_final_image = $this->image_settings($header_image);

        // //For Footer Logo
        // $footer_image = $request->file('logo_footer');
        // $footer_final_image = $this->image_settings($footer_image);

        // //Save All data
        // $items = new Website;
        // $items->seo_title = $request->seo_title;
        // $items->seo_description = $request->seo_description;
        // $items->seo_keywords = $request->seo_keywords;
        // $items->favicon = $fav_final_image ;
        // $items->logo_header =  $header_final_image;
        // $items->logo_footer = $footer_final_image;
        // $items->save();

        // return redirect()->route('settings.index')->with('success', 'Settings create successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $items = Website::findOrFail($id);
        // return view('layouts.backend.website.website-show', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $items = Website::findOrFail($id);
        // return view('layouts.backend.website.website-edit', compact('items'));
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
        // return $request;
        $request->validate([
            'favicon' => 'image',
            'logo_header' => 'image',
            'logo_footer' => 'image',
            'footer_about' => 'required',
            'seo_title' => 'max:60',
            'seo_description' => 'max:160'
        ]);

        $items = Website::findOrFail($id);

        //For Favicon
        if($request->file('favicon')){
            // unlink($items->favicon);
            $fav_image = $request->file('favicon');
            $fav_final_image = $this->image_settings($fav_image);
            $items->favicon = $fav_final_image ;
        }

        //For Header Logo
        if($request->file('logo_header')){
            // unlink($items->logo_header);
            $header_image = $request->file('logo_header');
            $header_final_image = $this->image_settings($header_image);
            $items->logo_header =  $header_final_image;
        }

         //For Footer Logo
        if($request->file('logo_footer')){
            // unlink($items->logo_footer);
            $footer_image = $request->file('logo_footer');
            $footer_final_image = $this->image_settings($footer_image);
            $items->logo_footer = $footer_final_image;
        }

        $items->seo_title = $request->seo_title;
        $items->seo_description = $request->seo_description;
        $items->seo_keywords = $request->seo_keywords;
        $items->footer_about = $request->footer_about;
        $items->need_varification = $request->need_varification;
        $items->save();

        return back()->with('success', 'Settings update successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Website::findOrFail($id)->delete();
        // return redirect()->back()->with('success', 'Settings delete successfully');
    }
}
