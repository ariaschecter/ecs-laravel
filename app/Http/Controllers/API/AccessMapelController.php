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
        if ($accessMapel) {
            return ResponseFormater::success($accessMapel, 'Sukses menampilkan data Access Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Access Mapel');
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
        //
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
        $updateDB = AccessMapel::where('access_mapel_id', $accessMapel->access_mapel_id);
        if ($updateDB) {
            return ResponseFormater::success($updateDB->get(), 'Sukses memperbarui data Access Model');
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
            return ResponseFormater::success(false, 'Sukses memperbarui data Access Model');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Access Model');
    }
}
