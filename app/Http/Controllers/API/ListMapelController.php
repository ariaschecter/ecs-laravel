<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        return response($list_mapels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // add($sub_mapel);

        ListMapel::create($list_mapel);
        return response($list_mapel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListMapel  $listMapel
     * @return \Illuminate\Http\Response
     */
    public function show(ListMapel $listMapel)
    {
        $list_mapels = ListMapel::where('list_mapel_id', $listMapel->list_mapel_id)->get();
        response($list_mapels);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListMapel  $listMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(ListMapel $listMapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListMapel  $listMapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListMapel $listMapel)
    {
        $update = $request->validate([
            'sub_mapel_id' => 'required',
            'list_mapel_no' => 'required',
            'list_mapel_name' => 'required',
            'list_mapel_link' => 'required',
            'list_mapel_desc' => 'required',
        ]);

        ListMapel::where('list_mapel_id', $listMapel->list_mapel_id)->update($update);
        return response($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListMapel  $listMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListMapel $listMapel)
    {
        ListMapel::where('list_mapel_id', $listMapel->list_mapel_id)->delete();
        return response(['mesage' => 'data berhasil dihapus']);
    }
}
