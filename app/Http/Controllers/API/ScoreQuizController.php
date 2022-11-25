<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChoiceQuiz;
use App\Models\ScoreQuiz;
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
        return ResponseFormater::success($score_quizs, 'Berhasil menampilkan Score Quiz');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ScoreQuiz $scoreQuiz)
    {
        $score = ScoreQuiz::where('id', $scoreQuiz->id)->get();
        return ResponseFormater::success($score, 'Sukses menampilkan Score by user');
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
        $create_score = ScoreQuiz::create($score);
        return ResponseFormater::success($create_score, 'Sukses menambahkan nilai');
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
        $update_score = ScoreQuiz::where('score_id', $scoreQuiz->score_id)->update($update);
        return ResponseFormater::success($update_score, 'success mengubah Score Quiz');
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
        return ResponseFormater::success(true, 'success menghapus Score Quiz');
    }
}
