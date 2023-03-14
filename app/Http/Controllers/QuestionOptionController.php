<?php

namespace App\Http\Controllers;

use App\Models\PollingQuestion;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuestionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.backend.question_option.question_option-index',[
            'options' => QuestionOption::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.question_option.question_option-create',[
            'questions' => PollingQuestion::latest()->get()
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
            'question_id' => 'required',
            'option' => 'required'
        ]);

        $cat = new QuestionOption();
        $cat->question_id = $request->question_id;
        $cat->option = $request->option;

        $cat->save();
        return redirect()->route('question_option.index')->with('success', 'Option create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionOption $questionOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('layouts.backend.question_option.question_option-edit',[
            'option' => QuestionOption::findOrFail($id),
            'questions' => PollingQuestion::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat =  QuestionOption::findOrFail($id);

        $request->validate([
            'question_id' => 'required',
            'option' => 'required'
        ]);

        
        $cat->question_id = $request->question_id;
        $cat->option = $request->option;

        $cat->save();
        return redirect()->route('question_option.index')->with('success', 'Option Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionOption  $questionOption
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        QuestionOption::findOrFail($id)->delete();
        return redirect()->route('question_option.index')->with('success', 'Option delete success');
    }


    public function questionOptionDelete($id) {
        QuestionOption::findOrFail($id)->delete();
        return response(['success' => 'data delete success']);
    }

}
