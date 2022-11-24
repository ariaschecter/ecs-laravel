<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChoiceQuiz;
use App\Models\QuestionQuiz;
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
        return ResponseFormater::success($choice_quizs, 'Berhasil menampilkan data Choice Quiz');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = QuestionQuiz::all();
        return ResponseFormater::success($questions, 'Berhasil menampilkan data Question Quiz');
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
            'choice_name' => 'required',
        ]);

        $choice_quiz = $request->except('_token');

        ChoiceQuiz::create($choice_quiz);
        return ResponseFormater::success($choice_quiz, 'Berhasil menambahkan data Choice Quiz');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChoiceQuiz  $choiceQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChoiceQuiz $choiceQuiz)
    {
        $request->validate([
            'question_id' => 'required',
            'choice_name' => 'required',
        ]);

        $update = $request->except('_token');
        $update['choice_score'] = $request->choice_score ? 1 : 0;

        // dd($update);

        $choice_quiz = ChoiceQuiz::where('choice_id', $choiceQuiz->choice_id)->update($update);
        return ResponseFormater::success($choice_quiz, 'Berhasil mengubah data Choice Quiz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChoiceQuiz  $choiceQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChoiceQuiz $choiceQuiz)
    {
        dd($choiceQuiz);
        ChoiceQuiz::where('question_id', $choiceQuiz->choice_id)->delete();
        return ResponseFormater::success(true, 'berhasil menghapus data Choice Quiz');
    }
}
