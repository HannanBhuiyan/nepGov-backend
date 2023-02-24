<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NormalOption;
use Illuminate\Http\Request;
use App\Models\PollingNormal;
use App\Models\PollingCategory;
use Illuminate\Support\Facades\DB;

class PollingNormalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::table('normal_reviews') 
        ->select(DB::raw('count(*) as count, topic_id'))
        ->groupBy('topic_id')
        ->get();

        $sss = $results->map(function($result){
            $options = DB::table('normal_reviews')
            ->select(DB::raw('count(*) as count, option_id'))
            ->where('topic_id', $result->topic_id)
            ->groupBy('option_id')
            ->get();

            $arr = array(
                "optionsData"=> $options,
                "topics" =>$result->topic_id,
                'totalCount' =>$result->count 
            );
 
            return $arr;
        });
        
        // return $sss;
        $normals  = PollingNormal::all();
        $polling_category = PollingCategory::all();
        return view('layouts.backend.polling_normal.polling_normal-index', compact('polling_category','normals','sss'));
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
        // return $request;
        $request->validate([
            'category_id' => 'required',
            'topic' => 'required'
        ]);

        $cat = new PollingNormal();
        $cat->category_id = $request->category_id;
        $cat->topic = $request->topic;
        $cat->save();

        foreach($request->option as $key=>$opt){
            NormalOption::insert([
                'option' => $request->option[$key],
                'topic_id' => $cat->id,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->route('polling_normal.index')->with('success', 'Normal Topic create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingNormal  $pollingNormal
     * @return \Illuminate\Http\Response
     */
    public function show(PollingNormal $pollingNormal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingNormal  $pollingNormal
     * @return \Illuminate\Http\Response
     */
    public function edit(PollingNormal $pollingNormal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingNormal  $pollingNormal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $normal = PollingNormal::findOrFail($id);
        $norm_opt = NormalOption::where('topic_id',$id)->get();
        
        $request->validate([
            'category_id' => 'required',
            'topic' => 'required'
        ]);
        
        // $cat->polling_category_id = $request->polling_category_id;
        $normal->category_id = $request->category_id;
        $normal->topic = $request->topic;
        
        $normal->save();
        
        foreach($norm_opt as $opt){
            $opt->delete();
        }

        if($request->option){
            foreach($request->option as $key=>$optn){
                NormalOption::insert([
                    'option' => $request->option[$key],
                    'topic_id' => $normal->id,
                    'created_at' => Carbon::now()
                ]);
            }
        }
        return redirect()->route('polling_normal.index')->with('success', 'Normal Topic Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingNormal  $pollingNormal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PollingNormal::findOrFail($id)->delete();
        return redirect()->route('polling_normal.index')->with('success', 'Normal Topic delete success');
        
    } 

}
