<?php

namespace App\Http\Controllers;

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
        return view('mapel.index')->with('mapels', $mapels);
    }

    public function show(Mapel $mapel)
    {
        return view('mapel.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.add');
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

        Mapel::create($mapel);
        return redirect('mapel');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        return view('mapel.edit')->with([
            'mapel' => $mapel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        $update['mapel_active'] = $request->mapel_active ? '1':'0';

        // dd($update);
        Mapel::where('mapel_id', $mapel->mapel_id)->update($update);
        return redirect('mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        Mapel::where('mapel_id', $mapel->mapel_id)->delete();
        Storage::delete($mapel->mapel_picture);
        return redirect('mapel');
    }
}
