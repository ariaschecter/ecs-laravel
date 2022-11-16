<?php

namespace App\Http\Controllers;

use App\Models\ChoiceQuiz;
use App\Models\QuestionQuiz;
use App\Models\SubMapel;
use Illuminate\Http\Request;

class QuestionQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question_quizs = QuestionQuiz::with('sub_mapel.mapel')->get();
        return view('question.index')->with('question_quizs', $question_quizs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_mapels = SubMapel::with('mapel')->get();
        return view('question.add')->with('sub_mapels', $sub_mapels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question_quiz = $request->validate([
            'sub_mapel_id' => 'required',
            'question' => 'required',
        ]);
        // dd($sub_mapel);

        QuestionQuiz::create($question_quiz);
        return redirect('question/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionQuiz $question_quiz)
    {
        $sub_mapels = SubMapel::all();
        return view('question.edit')->with([
            'question' => $question_quiz,
            'sub_mapels' => $sub_mapels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionQuiz $question_quiz)
    {
        $update = $request->validate([
            'sub_mapel_id' => 'required',
            'question' => 'required',
        ]);

        QuestionQuiz::where('question_id', $question_quiz->question_id)->update($update);
        return redirect('question/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionQuiz $question_quiz)
    {
        QuestionQuiz::where('question_id', $question_quiz->question_id)->delete();
        return redirect('question/');
    }

    public function quiz() {
        $quizs = QuestionQuiz::with('choice')->get();
        return view('question.quiz')->with([
            'questions' => $quizs,
        ]);
    }

    public function result(Request $request) {
        $results = $request->except('_token');
        $soal = 0;
        $benar = 0;
        foreach($results as $result) {
            $score = ChoiceQuiz::where('choice_id', $result)->first();
            $benar += $score->choice_score;
            $soal++;
        }

        return $benar * 100 / $soal;
    }
}
