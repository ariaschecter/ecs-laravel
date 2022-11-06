<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AccessMapel;
use Illuminate\Http\Request;

class AccessMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessMapel = AccessMapel::all();
        if (count($accessMapel) > 0) {
            return ResponseFormater::success($accessMapel, 'Sukses menampilkan data Access Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Access Mapel!, Data kosong!!!', 404);
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
        $create = $request->validate([
            'id' => 'required',
            'mapel_id' => 'required',
            'count_sub_mapel' => 'required',
            'count_list_mapel' => 'required',
        ]);

        $createDB = AccessMapel::create($create);
        if ($createDB) {
            return ResponseFormater::success($create, 'Sukses menambahakan data Access Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data Access Mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessMapel  $accessMapel
     * @return \Illuminate\Http\Response
     */
    public function show(AccessMapel $accessMapel)
    {
        $show = AccessMapel::where('access_mapel_id', $accessMapel->access_mapel_id)->get();
        return ResponseFormater::success($show, 'Sukses menampilkan data Access Mapel');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessMapel  $accessMapel
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessMapel $accessMapel)
    {
        $show = AccessMapel::where('id', $accessMapel->id)->get();
        return ResponseFormater::success($show, 'Sukses menampilkan data Access Mapel');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccessMapel  $accessMapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessMapel $accessMapel)
    {
        $accessmapelDB = AccessMapel::where('access_mapel_id', $accessMapel->access_mapel_id);
        if ($accessmapelDB->update($request->all())) {
            return ResponseFormater::success($accessmapelDB->get(), 'Sukses memperbarui data Access Model');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Access Model');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessMapel  $accessMapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessMapel $accessMapel)
    {
        $deleteDB = AccessMapel::where('access_mapel_id', $accessMapel->access_mapel_id)->delete();
        if ($deleteDB) {
            return ResponseFormater::success(false, 'Sukses menghapus data Access Model');
        }
        return ResponseFormater::error(false, 'Gagal menghapus data Access Model');
    }
}
