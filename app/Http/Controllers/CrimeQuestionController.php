<?php

namespace App\Http\Controllers;

use App\Models\CrimeQuestion;
use Illuminate\Http\Request;

class CrimeQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = CrimeQuestion::latest()->get();
        return view('layouts.backend.crime_question.crime_question-index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend.crime_question.crime_question-create');
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
            'crime_type' => 'required',
            'question' => 'required',
            'answer_type' => 'required',
        ]);
        
        $ques = new CrimeQuestion();
        $ques->crime_type = $request->crime_type;
        $ques->question = $request->question;
        $ques->answer_type = $request->answer_type;

        $ques->save();
        return redirect()->route('crime_question.index')->with('success', 'Question create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CrimeQuestion  $crimeQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(CrimeQuestion $crimeQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CrimeQuestion  $crimeQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = CrimeQuestion::findOrFail($id);
        return view('layouts.backend.crime_question.crime_question-edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CrimeQuestion  $crimeQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'crime_type' => 'required',
            'question' => 'required',
            'answer_type' => 'required',
        ]);
        
        $ques = CrimeQuestion::findOrFail($id);
        $ques->crime_type = $request->crime_type;
        $ques->question = $request->question;
        $ques->answer_type = $request->answer_type;

        $ques->save();
        return redirect()->route('crime_question.index')->with('success', 'Question update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CrimeQuestion  $crimeQuestion
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        CrimeQuestion::findOrFail($id)->delete();
        return redirect()->route('crime_question.index')->with('success', 'Question delete success');
    }
}
