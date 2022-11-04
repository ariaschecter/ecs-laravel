<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubMapel;
use Illuminate\Http\Request;

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
        if ($sub_mapels) {
            return ResponseFormater::success($sub_mapels, 'Sukses menampilkan data Sub Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Sub Mapel');
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
        $sub_mapel = $request->validate([
            'mapel_id' => 'required',
            'sub_mapel_no' => 'required',
            'sub_mapel_name' => 'required',
        ]);
        // dd($sub_mapel);

        $createDB = SubMapel::create($sub_mapel);
        if ($createDB) {
            return ResponseFormater::success($sub_mapel, 'Sukses menambahkan data Sub Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data Sub Mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubMapel  $subMapel
     * @return \Illuminate\Http\Response
     */
    public function show(SubMapel $subMapel)
    {
        $sub_mapels = SubMapel::where('sub_mapel_id', $subMapel->sub_mapel_id)->get();
        return ResponseFormater::success($sub_mapels, 'Sukses menampilkan data Sub Mapel');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubMapel  $subMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(SubMapel $subMapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubMapel  $subMapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubMapel $subMapel)
    {
        $update = $request->validate([
            'mapel_id' => 'required',
            'sub_mapel_no' => 'required',
            'sub_mapel_name' => 'required',
        ]);

        $updateDB = SubMapel::where('sub_mapel_id', $subMapel->sub_mapel_id)->update($update);
        if ($updateDB) {
            return ResponseFormater::success($update, 'Sukses memperbarui data Sub Mapel');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Sub Mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMapel  $subMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMapel $subMapel)
    {
        $deleteDB = SubMapel::where('sub_mapel_id', $subMapel->sub_mapel_id)->delete();

        if ($deleteDB) {
            return ResponseFormater::success(false, 'Sukses menghapus data Sub Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menghapus data Sub Mapel');
    }
}
