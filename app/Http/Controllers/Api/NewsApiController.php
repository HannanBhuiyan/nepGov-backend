<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\backend\CategoryController;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class NewsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return response()->json($news);
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
        $rules = array(
            'title' => 'required|unique:news',
            'slug' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        );

        $cat_name = category::findOrFail($request->category_id);

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $image = $request->file('feature_image');
            $imag_ext = $image->getClientOriginalExtension();
    
            $hexCode = hexdec(uniqid());
            $full_name = $hexCode.'.'.$imag_ext;
            $upload_location = 'backend/assets/uploads/news/';
            $last_image = $upload_location.$full_name;
            Image::make($image)->resize(300, 300)->save($last_image);
            
            $data = new News;

            $data->category_id = $request->category_id;
            $data->category_name = $cat_name->title;
            $data->title = $request->title;
            $data->slug = $request->slug;
            $data->feature_image = $last_image;
            $data->description = $request->description;
            $data->seo_title = $request->seo_title;
            $data->seo_desc = $request->seo_desc;
            $data->save();

            return response()->json(['status'=>200, 'success'=>'News Create Success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = News::where('slug',$slug)->first();
        $category_name = category::findOrFail($news->category_id)->title;
        return response()->json(['category_name'=>$category_name, 'news'=> $news ]);
        
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
        $data = News::findOrFail($id);
        
        $cat_name = category::findOrFail($request->category_id);

        $rules = array(
            'title' => 'required|unique:news,title,'.$data->id,
            'slug' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $data->category_id = $request->category_id;
            $data->category_name = $cat_name->title;
            $data->title = $request->title;
            $data->slug = $request->slug;
            $data->description = $request->description;
            $data->seo_title = $request->seo_title;
            $data->seo_desc = $request->seo_desc;

            if($request->hasFile('feature_image')){
                $image = $request->file('feature_image');
                $imag_ext = $image->getClientOriginalExtension();
        
                $hexCode = hexdec(uniqid());
                $full_name = $hexCode.'.'.$imag_ext;
                $upload_location = 'backend/assets/uploads/news/';
                $last_image = $upload_location.$full_name;
                Image::make($image)->resize(300, 300)->save($last_image);
                
                $data->feature_image = $last_image;
            }

            $data->save();
            return response()->json(['status'=>200, 'success'=>'News Update Success']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function category_wise_news(Request $request, $slug)
    {
        // return $slug;
         $cat_id = category::where('slug',$slug)->first();
        
         $all_news = News::where('category_id',$cat_id->id)->get();
        
        $count = $all_news->count();

        return response()->json(['data'=>$all_news]);
    }

    public function related_category_news($slug)
    {
        // return $slug;
        $cat_id = News::where('slug', $slug)->first();
      
        $related_news = News::where('category_id', $cat_id->id)->where('slug','!=',$slug)->get();
        // $count = $related_news->count();

        return response()->json(['data'=>$related_news]);
    }

}
