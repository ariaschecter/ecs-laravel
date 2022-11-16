<?php

namespace App\Http\Controllers;

use App\Models\ChoiceQuiz;
use App\Models\QuestionQuiz;
use App\Models\SubMapel;
use Illuminate\Http\Request;

class ChoiceQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choice_quizs = ChoiceQuiz::with('question')->orderBy('question_id', 'DESC')->get();
        return view('choice.index')->with('choice_quizs', $choice_quizs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = QuestionQuiz::all();
        return view('choice.add')->with('questions', $questions);
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
            'choice_name' => 'required',
        ]);

        $choice_quiz = $request->except('_token');

        ChoiceQuiz::create($choice_quiz);
        return redirect('choice/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ChoiceQuiz $choice_quiz)
    {
        $questions = QuestionQuiz::all();
        return view('choice.edit')->with([
            'choice' => $choice_quiz,
            'questions' => $questions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChoiceQuiz $choice_quiz)
    {
        $request->validate([
            'choice_name' => 'required',
        ]);

        $update = $request->except('_token');
        $update['choice_score'] = $request->choice_score ? 1 : 0;

        // dd($update);

        ChoiceQuiz::where('choice_id', $choice_quiz->choice_id)->update($update);
        return redirect('choice/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChoiceQuiz $choice_quiz)
    {
        ChoiceQuiz::where('question_id', $choice_quiz->choice_id)->delete();
        return redirect('choice/');
    }
}

