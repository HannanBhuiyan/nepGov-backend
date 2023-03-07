<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PageViewCount;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class PageApiController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return response()->json($pages);
    }

    public function store(Request $request)
    {
        $rules = array(
            'page_title' => 'required|unique:pages',
            'placement' => 'required',
            'slug' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $page = new Page;
            $page->page_title = $request->page_title;
            $page->slug = $request->slug;
            $page->description = $request->description;
            $page->placement = $request->placement;
            $page->footer_column = $request->footer_column;
            $page->seo_title = $request->seo_title;
            $page->seo_description = $request->seo_description;
            $page->save();

            return response()->json(['status'=>200, 'success'=>'Page Create Success']);
        }
    }

    public function show($id)
    {
        $pages = Page::findOrFail($id);
        return response()->json($pages);
    }

    public function update(Request $request, $id)
    {
        $pages = Page::findOrFail($id);
        
        $rules = array(
            'page_title' => 'required|unique:pages,page_title,'.$pages->id,
            'placement' => 'required',
            'slug' => 'required',
        );

        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            
            $pages->page_title = $request->page_title;
            $pages->slug = $request->slug;
            $pages->description = $request->description;
            $pages->placement = $request->placement;
            $pages->footer_column = $request->footer_column;
            $pages->seo_title = $request->seo_title;
            $pages->seo_description = $request->seo_description;
            $pages->save();
            return response()->json(['status'=>200, 'success'=>'Page Update Success']);
        }
        
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();
        return response()->json(['status'=>200, 'success'=>'Page Delete Success']);
        
    }

    public function page_details(Request $request, $slug)
    {
        $page = Page::where('slug',$slug)->first();
        
        // check exists ip address  
        $exists_ip = PageViewCount::where('ip_address', $request->ip())->where('page_id', $page->id)->exists();
   
        // chack exists ip and insert
        if(!$exists_ip){ 
            PageViewCount::insert([
                'page_id' => $page->id,
                'ip_address' => $request->ip(),
            ]); 
        }

        // count exists view
        $pageViewsCount = PageViewCount::where('page_id', $page->id)->count();
        $page->update([
            'view_count' => $pageViewsCount,
        ]);
        
        // result
        return response()->json(['page'=> $page]);
        
    }

}
