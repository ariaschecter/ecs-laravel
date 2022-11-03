<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = Mapel::all();
        if ($mapels) {
            return ResponseFormater::success($mapels, 'Sukses menampilkan data Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Mapel');
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
        $request->validate([
            'mapel_name' => 'required',
            'mapel_picture' => 'required|file|image|max:5120',
            'semester_id' => 'required',
        ]);

        $mapel_picture = $request->file('mapel_picture')->store('img/mapel');

        $mapel = $request->except(['_token', 'mapel_picture']);
        $mapel['mapel_slug'] = Str::slug($request->mapel_name, '-');
        $mapel['mapel_picture'] = $mapel_picture;

        $createDB = Mapel::create($mapel);

        if ($createDB) {
            return ResponseFormater::success($mapel, 'Sukses menambahkan data Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data Mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        $sub_mapels = Mapel::where('mapel_id', $mapel->mapel_id)->get();
        if ($sub_mapels) {
            return ResponseFormater::success($sub_mapels, 'Sukses menampilkan data Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Mapel');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'mapel_name' => 'required',
            'mapel_picture' => 'file|image|max:5120',
            'semester_id' => 'required',
        ]);

        if ($request->mapel_picture) {
            Storage::delete($mapel->mapel_picture);
            $mapel_picture = $request->file('mapel_picture')->store('img/mapel');
        } else {
            $mapel_picture = $mapel->mapel_picture;
        }

        $update = $request->except(['_token', 'mapel_picture']);
        $update['mapel_slug'] = Str::slug($request->mapel_name, '-');
        $update['mapel_picture'] = $mapel_picture;
        $update['mapel_active'] = $request->mapel_active ? '1' : '0';

        // dd($update);
        $updateDB = Mapel::where('mapel_id', $mapel->mapel_id)->update($update);
        if ($updateDB) {
            return ResponseFormater::success($update, 'Sukses memperbarui data Mapel');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        $deleteDB = Mapel::where('mapel_id', $mapel->mapel_id)->delete();
        $deleteStr = Storage::delete($mapel->mapel_picture);
        if ($deleteDB && $deleteStr) {
            return ResponseFormater::success(false, 'Sukses menghapus data Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menghapus data Mapel');
    }
}
