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
        if ($list_mapels) {
            return ResponseFormater::success($list_mapels, 'Sukses menampilkan seluruh data');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan seluruh data');
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

        $createDB = ListMapel::create($list_mapel);
        if ($createDB) {
            return ResponseFormater::success($list_mapel, 'Sukses menambahkan data List Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data List Mapel');
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
        return ResponseFormater::success($list_mapels, 'Sukses menampilkan data List Mapel');
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
        $validate = $request->validate([
            'sub_mapel_id' => 'required',
            'list_mapel_no' => 'required',
            'list_mapel_name' => 'required',
            'list_mapel_link' => 'required',
            'list_mapel_desc' => 'required',
        ]);

        $updateDB = ListMapel::where('list_mapel_id', $listMapel->list_mapel_id)->update($validate);
        if ($updateDB) {
            return ResponseFormater::success($validate, 'Sukses memperbarui data List Mapel');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data List Mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListMapel  $listMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListMapel $listMapel)
    {
        $deleteDB = ListMapel::where('list_mapel_id', $listMapel->list_mapel_id)->delete();
        if ($deleteDB) {
            return ResponseFormater::success(false, 'Sukses menghapus data List Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menghapus data List Mapel');
    }
}
