<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SurvayOption;
use App\Models\SurvayQuestion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SurvayController extends Controller
{
    public function index()
    {
        $survay_questions = SurvayQuestion::latest()->get();
        return view('layouts.backend.survay_question.survay_question-index', compact('survay_questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'survay_question' => 'required',
            'slug' => 'required'
        ]);

        $question = new SurvayQuestion();
        $question->survay_question = $request->survay_question;
        $question->slug = $request->slug;
        $question->save();

        
        if($request->options){
            SurvayOption::insert([
                'options' => json_encode($request->options),
                'answer_type' => $request->answer_type,
                'survay_question_id' => $question->id,
                'created_at' => Carbon::now()
            ]);
        }else{
            SurvayOption::insert([
                'answer_type' => $request->answer_type,
                'survay_question_id' => $question->id,
                'created_at' => Carbon::now()
            ]);
        }

        return back()->with('success', 'Question added success');
    }

    public function update(Request $request, $id)
    {
        $servay = SurvayQuestion::find($id);
        $servay->update([
            'survay_question' => $request->survay_question
        ]);

        return back()->with('success', 'Question Updated success');
    }

    public function delete($id)
    {
        $ser_opt = SurvayOption::where('survay_question_id',$id)->get();
        foreach($ser_opt as $opt){
            $opt->delete();
        }
        $servay = SurvayQuestion::find($id);
        $servay->delete();
        return back()->with('success', 'Question Deleted success');
    }
}
