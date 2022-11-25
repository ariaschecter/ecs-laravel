<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChoiceQuiz;
use App\Models\ScoreQuiz;
use App\Models\SubMapel;
use App\Models\User;
use Illuminate\Http\Request;

class ScoreQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $score_quizs = ScoreQuiz::with(['user', 'sub_mapel.mapel'])->get();
        return view('score.index')->with('score_quizs', $score_quizs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $sub_mapels = SubMapel::with('mapel')->get();
        return view('score.add')->with([
            'users' => $users,
            'sub_mapels' => $sub_mapels,
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
        $results = $request->except(['id', 'sub_mapel_id', '_token']);
        $soal = 0;
        $benar = 0;
        foreach ($results as $result) {
            $score = ChoiceQuiz::where('choice_id', $result)->first();
            $benar += $score->choice_score;
            $soal++;
        }
        $score = [
            'id' => $request->id,
            'sub_mapel_id' => $request->sub_mapel_id,
            'score' => $benar * 100 / $soal,
        ];
        ScoreQuiz::create($score);
        return redirect('score/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoreQuiz $scoreQuiz)
    {
        $sub_mapels = SubMapel::all();
        return view('score.edit')->with([
            'score' => $scoreQuiz,
            'sub_mapels' => $sub_mapels,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreQuiz  $scoreQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoreQuiz $scoreQuiz)
    {
        $update = $request->validate([
            'id' => 'integer',
            'score' => 'required',
        ]);
        ScoreQuiz::where('score_id', $scoreQuiz->score_id)->update($update);
        return redirect('score/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoreQuiz  $scoreQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreQuiz $scoreQuiz)
    {
        ScoreQuiz::where('score_id', $scoreQuiz->score_id)->delete();
        return redirect('score/');
    }
}
