<?php

namespace App\Http\Controllers\backend;

use App\Models\News;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PollingCategory;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('layouts.backend.news.news-index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        return view('layouts.backend.news.news-create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required|unique:news',
            'slug' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'seo_title' => 'max:60',
            'seo_desc' => 'max:160'
        ],[
            'title.required' => 'News title is required',
            'category_id.required' => 'Select a Category',
            'description.required' => 'Write Short Description',
            'seo_desc.max' => 'description max length 160 char'
        ]);

        $cat_name = category::findOrFail($request->category_id);

        $feature_image = $request->file('feature_image');
        $image_ext = $feature_image->getClientOriginalExtension();
        $upload_location = 'backend/assets/uploads/news/';
        $final_image = $upload_location.hexdec(uniqid()).'.'.$image_ext;
        Image::make($feature_image)->resize(1900, 466)->save($final_image);

        // $image = $request->file('image');
        // $imag_ext = $image->getClientOriginalExtension();
        // $location = 'backend/assets/uploads/news/';
        // $last_image = $location.hexdec(uniqid()).'.'.$imag_ext;
        // Image::make($image)->resize(360, 360)->save($last_image);

        $data = new News;

        $data->category_id = $request->category_id;
        $data->category_name = $cat_name->title;
        $data->title = $request->title;
        $data->slug = $request->slug;
        $data->feature_image = $final_image;
        // $data->image = $last_image;
        $data->description = $request->description;
        $data->seo_title = $request->seo_title;
        $data->seo_desc = $request->seo_desc;
        $data->save();

        return redirect()->route('news.index')->with('success', 'News Added success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('layouts.backend.news.news-show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = category::all();
        $news = News::findOrFail($id);
        return view('layouts.backend.news.news-edit', compact('news','categories'));
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
            'title' => 'required|unique:news,title,'.$id,
            'slug' => 'required',
            'description' => 'required',
            'seo_title' => 'max:60',
            'seo_desc' => 'max:160'
        ],[
            'title.required' => 'News title is required',
            'description.required' => 'Write Short Description'
        ]);

        $cat_name = category::findOrFail($request->category_id);

        $data = News::findOrFail($id);

        $data->category_id = $request->category_id;
        $data->category_name = $cat_name->title;
        $data->title = $request->title;
        $data->slug = $request->slug;
        $data->description = $request->description;
        $data->seo_title = $request->seo_title;
        $data->seo_desc = $request->seo_desc;

        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $imag_ext = $image->getClientOriginalExtension();
        //     $hexCode = hexdec(uniqid());
        //     $full_name = $hexCode.'.'.$imag_ext;
        //     $upload_location = 'backend/assets/uploads/news/';
        //     $last_image = $upload_location.$full_name;
        //     Image::make($image)->resize(360, 360)->save($last_image);
        //     $data->image = $last_image;
        // }
        if($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $imag_ext = $image->getClientOriginalExtension();
            $hexCode = hexdec(uniqid());
            $full_name = $hexCode.'.'.$imag_ext;
            $upload_location = 'backend/assets/uploads/news/';
            $last_image = $upload_location.$full_name;
            Image::make($image)->resize(1900, 466)->save($last_image);
            $data->feature_image = $last_image;
        }

        $data->save();

        return redirect()->route('news.index')->with('success', 'News Update success');
    }


    public function delete($id)
    {
        News::findOrFail($id)->delete();
        return redirect()->route('news.index')->with('fail', 'News delete success');
    }

    public function category_wise_news(Request $request)
    {
        if ($request->category_id != null) {
            $all_news = News::where('category_id',$request->category_id)->get();
        } else {
            $all_news= News::latest()->get();
        }

        $count = $all_news->count();

        // $view = view('frontend_pages.blog_search',compact('all_blogs'))->render();

        return response()->json(['data'=>$all_news , 'count' => $count]);
    }

}
