<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('layouts.backend.page.page-index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('layouts.backend.page.page-create');
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
            'page_title' => 'required|unique:pages',
            'placement' => 'required',
            'slug' => 'required',
            'seo_title' => 'max:60',
            'seo_description' => 'max:160'
        ],[
            'page_title.required' => 'Page title is required !',
            'placement.required' => 'Placement is required !',
            'slug.required' => 'Slug is required !',
        ]);

        $page = new Page;
        $page->page_title = $request->page_title;
        $page->slug = $request->slug;
        $page->description = $request->description;
        $page->placement = $request->placement;
        $page->footer_column = $request->footer_column;
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        return redirect()->route('page.index')->with('success', 'Page add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pages = Page::findOrFail($id);
        return view('layouts.backend.page.page-show', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = Page::findOrFail($id);
        return view('layouts.backend.page.page-edit', compact('pages'));
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
            'page_title' => 'required|unique:pages,page_title,'.$id,
            'placement' => 'required',
            'slug' => 'required',
            'seo_title' => 'max:60',
            'seo_description' => 'max:160'
        ],[
            'page_title.required' => 'Page title is required !',
            'placement.required' => 'Placement is required !',
            'slug.required' => 'Slug is required !',
        ]);


        $pages = Page::findOrFail($id);
        $pages->page_title = $request->page_title;
        $pages->slug = $request->slug;
        $pages->description = $request->description;
        $pages->placement = $request->placement;
        $pages->footer_column = $request->footer_column;
        $pages->seo_title = $request->seo_title;
        $pages->seo_description = $request->seo_description;
        $pages->save();

        return redirect()->route('page.index')->with('success', 'Page update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Page delete successfully');
    }
}
