<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\SubMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_mapels = SubMapel::all();
        return view('sub_mapel.index')->with('sub_mapels', $sub_mapels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mapels = Mapel::all();
        return view('sub_mapel.add')->with('mapels', $mapels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub_mapel = $request->validate([
            'mapel_id' => 'required',
            'sub_mapel_no' => 'required',
            'sub_mapel_name' => 'required',
        ]);
        // dd($sub_mapel);

        SubMapel::create($sub_mapel);
        return redirect('mapel/show/' . $request->mapel_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubMapel $sub_mapel)
    {
        $mapels = Mapel::all();
        return view('sub_mapel.edit')->with([
            'sub_mapel' => $sub_mapel,
            'mapels' => $mapels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubMapel $sub_mapel)
    {
        $update = $request->validate([
            'mapel_id' => 'required',
            'sub_mapel_no' => 'required',
            'sub_mapel_name' => 'required',
        ]);

        SubMapel::where('sub_mapel_id', $sub_mapel->sub_mapel_id)->update($update);
        return redirect('mapel/show/' . $request->mapel_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMapel $sub_mapel)
    {
        SubMapel::where('sub_mapel_id', $sub_mapel->sub_mapel_id)->delete();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }
}
