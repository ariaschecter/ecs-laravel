<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        return ResponseFormater::success($question_quizs, 'Sukses menampilkan Question Quiz');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_mapels = SubMapel::with('mapel')->get();
        return ResponseFormater::success($sub_mapels, 'Sukses menampilkan Sub Mapel');
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

        $sub_mapels = QuestionQuiz::create($question_quiz);
        return ResponseFormater::success($sub_mapels, 'Sukses menambahkan Sub Mapel');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionQuiz  $questionQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionQuiz $questionQuiz)
    {
        $update = $request->validate([
            'sub_mapel_id' => 'required',
            'question' => 'required',
        ]);

        $question_quiz = QuestionQuiz::where('question_id', $questionQuiz->question_id)->update($update);
        return ResponseFormater::success($question_quiz, 'Sukses mengubah Question Quiz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionQuiz  $questionQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionQuiz $questionQuiz)
    {
        QuestionQuiz::where('question_id', $questionQuiz->question_id)->delete();
        return ResponseFormater::success(true, 'Sukses menghapus Question Quiz');
    }

    public function quiz()
    {
        $quizs = QuestionQuiz::with('choice')->get();
        return ResponseFormater::success($quizs, 'Sukses menampikan Question Quiz sesuai choice quiz');
    }

    public function result(Request $request)
    {
        $results = $request->except('_token');
        $soal = 0;
        $benar = 0;
        foreach ($results as $result) {
            $score = ChoiceQuiz::where('choice_id', $result)->first();
            $benar += $score->choice_score;
            $soal++;
        }

        return ResponseFormater::success($benar * 100 / $soal, 'Sukses result');
    }
}
