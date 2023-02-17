<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SocialLinks;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = SocialLinks::first();
        return view('layouts.backend.socialLink.social-index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('layouts.backend.socialLink.social-create');
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
        //     "*" => 'url'
        // ]);

        // $socialurl = new SocialLinks;
        // $socialurl->facebook = $request->facebook;
        // $socialurl->twitter = $request->twitter;
        // $socialurl->instagram = $request->instagram;
        // $socialurl->linkedin = $request->linkedin;
        // $socialurl->youtube = $request->youtube;
        // $socialurl->save();

        // return redirect()->route('social_links.index')->with('success', 'SocialLinks add successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $items = SocialLinks::findOrFail($id);
        // return view('layouts.backend.socialLink.social-edit', compact('items'));
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
        $request->validate([
            "facebook" => 'nullable|url',
            "twitter" => 'nullable|url',
            "instagram" => 'nullable|url',
            "linkedin" => 'nullable|url',
            "youtube" => 'nullable|url',
        ]);
        
        $socialurl = SocialLinks::findOrFail($id);
        $socialurl->facebook = $request->facebook;
        $socialurl->twitter = $request->twitter;
        $socialurl->instagram = $request->instagram;
        $socialurl->linkedin = $request->linkedin;
        $socialurl->youtube = $request->youtube;
        $socialurl->save();

        return back()->with('success', 'SocialLinks update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // SocialLinks::findOrFail($id)->delete();
        // return redirect()->back()->with('success', 'SocialLinks delete successfully');
    }
}
