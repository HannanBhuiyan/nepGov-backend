<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PollingReview;
use App\Models\QuestionOption;
use App\Models\PollingCategory;
use App\Models\PollingQuestion;
use App\Models\PollingSubCategory;
use Illuminate\Support\Facades\DB;

class PollingQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $results = DB::table('polling_reviews') 
        ->select(DB::raw('count(*) as count, question_id'))
        ->groupBy('question_id')
        ->get();

        $sss = $results->map(function($result,$index){
            $options = DB::table('polling_reviews')
            ->select(DB::raw('count(*) as count, polling_option_id'))
            ->where('question_id', $result->question_id)
            ->groupBy('polling_option_id')
            ->get();

            $arr = array(
                "optionsData"=> $options,
                "question" =>$result->question_id,
                'totalCount' =>$result->count 
            );
 
            return $arr;
        });

        return view('layouts.backend.polling_question.polling_question-index',[
            'questions' => PollingQuestion::latest()->get(),
            'sub_category' => PollingSubCategory::all(),
            'sss' => $sss
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.polling_question.polling_question-create',[
            'category' => PollingCategory::all()
        ]);
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
            'polling_category_id' => 'required',
            'sub_category_id' => 'required',
            'question' => 'required',
            'slug' => 'required'
        ]);

        $cat = new PollingQuestion();
        $cat->polling_category_id = $request->polling_category_id;
        $cat->sub_category_id = $request->sub_category_id;
        $cat->question = $request->question;
        $cat->slug = $request->slug;

        $cat->save();

        foreach($request->option as $key=>$opt){
            QuestionOption::insert([
                'option' => $request->option[$key],
                'question_id' => $cat->id,
                'created_at' => Carbon::now()
            ]);
        }

        return redirect()->route('polling_category.index')->with('success', 'Question create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(PollingQuestion $pollingQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('layouts.backend.polling_question.polling_question-edit',[
            'question' => PollingQuestion::findOrFail($id),
            'sub_category' => PollingSubCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $cat = PollingQuestion::findOrFail($id);
        $que_opt = QuestionOption::where('question_id',$id)->get();
    
        // for validation
        $request->validate([
            'sub_category_id' => 'required',
            'question' => 'required'
        ]);
      
        // for save 
        $cat->sub_category_id = $request->sub_category_id;
        $cat->question = $request->question;
        $cat->save();
         
        
        // for multiple option update settings
        foreach($que_opt as $index => $value){ 
            QuestionOption::find($value->id)->update([
                'option' => $request->option[$index]
            ]);
          
        }  
        
        // for new value insert
        foreach($request->option as $key=>$value){ 
            $newOptions = QuestionOption::firstOrNew (
                ['option' =>  $request->option[$key] ],
                ['question_id' => $cat->id ]
            );
            $newOptions->save(); 
        }

        return back();
        return redirect()->route('polling_question.index')->with('success', 'Question Update success');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingQuestion  $pollingQuestion
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $opt = QuestionOption::where('question_id', $id)->get();
        foreach($opt as $opt){
            $opt->delete();  
        };
        PollingQuestion::findOrFail($id)->delete();
        return redirect()->route('polling_question.index')->with('success', 'Question delete success');
        
    }

    public function category_dropdown(Request $request)
    {
        $show_sub_cat = "<option value>Select Sub Cat</option>";
        $sub_cat = PollingSubCategory::where('category_id', $request->cat_id)->get(['id','name']);
        foreach ($sub_cat as $cat) {
            // echo $cat->name .= "<option value='$cat->id'>$cat->name</option>";
            $show_sub_cat .= "<option value='$cat->id'>$cat->name</option>";
        }
        echo $show_sub_cat;
    }

}
