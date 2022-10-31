<?php

namespace App\Http\Controllers;

use App\Models\ListMapel;
use App\Models\SubMapel;
use Illuminate\Http\Request;

class ListMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_mapels = ListMapel::all();
        return view('list_mapel.index')->with('list_mapels', $list_mapels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_mapels = SubMapel::all();
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

        ListMapel::create($list_mapel);
        $sub_mapel = SubMapel::where('sub_mapel_id', $request->sub_mapel_id)->first();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ListMapel $list_mapel)
    {
        $sub_mapels = SubMapel::all();
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
    public function update(Request $request, ListMapel $list_mapel)
    {
        $update = $request->validate([
            'sub_mapel_id' => 'required',
            'list_mapel_no' => 'required',
            'list_mapel_name' => 'required',
            'list_mapel_link' => 'required',
            'list_mapel_desc' => 'required',
        ]);

        ListMapel::where('list_mapel_id', $list_mapel->list_mapel_id)->update($update);
        $sub_mapel = SubMapel::where('sub_mapel_id', $request->sub_mapel_id)->first();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListMapel $list_mapel)
    {
        ListMapel::where('list_mapel_id', $list_mapel->list_mapel_id)->delete();
        $sub_mapel = SubMapel::where('sub_mapel_id', $list_mapel->sub_mapel_id)->first();
        return redirect('mapel/show/' . $sub_mapel->mapel_id);
    }
}
