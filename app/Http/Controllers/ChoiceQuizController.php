<?php

namespace App\Http\Controllers;

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
        $list_mapels = ChoiceQuiz::all();
        return view('list_mapel.index')->with('list_mapels', $list_mapels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_mapels = QuestionQuiz::all();
        // dd($sub_mapels);
        return view('list_mapel.add')->with('sub_mapels', $sub_mapels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $list_mapel = $request->validate([
            'sub_mapel_id' => 'required',
            'list_mapel_no' => 'required',
            'list_mapel_name' => 'required',
            'list_mapel_link' => 'required',
            'list_mapel_desc' => 'required',
        ]);
        // dd($sub_mapel);

        ChoiceQuiz::create($list_mapel);
        $sub_mapel = QuestionQuiz::where('sub_mapel_id', $request->sub_mapel_id)->first();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ChoiceQuiz $list_mapel)
    {
        $sub_mapels = QuestionQuiz::all();
        return view('list_mapel.edit')->with([
            'list_mapel' => $list_mapel,
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
    public function update(Request $request, ChoiceQuiz $list_mapel)
    {
        $update = $request->validate([
            'sub_mapel_id' => 'required',
            'list_mapel_no' => 'required',
            'list_mapel_name' => 'required',
            'list_mapel_link' => 'required',
            'list_mapel_desc' => 'required',
        ]);

        ChoiceQuiz::where('list_mapel_id', $list_mapel->list_mapel_id)->update($update);
        $sub_mapel = QuestionQuiz::where('sub_mapel_id', $request->sub_mapel_id)->first();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChoiceQuiz $list_mapel)
    {
        ChoiceQuiz::where('list_mapel_id', $list_mapel->list_mapel_id)->delete();
        $sub_mapel = QuestionQuiz::where('sub_mapel_id', $list_mapel->sub_mapel_id)->first();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }
}
