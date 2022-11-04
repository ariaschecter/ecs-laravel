<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        if (count($roles) > 0) {
            return ResponseFormater::success($roles, 'Sukses menampilkan data Role');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Role!, Data kosong!!!', 404);
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
            'role_name' => 'required|unique:roles,role_name',
        ]);

        $role = $request->except(['_token']);
        $createDB = Role::create($role);

        if ($createDB) {
            return ResponseFormater::success($role, 'Sukses menambahkan data Role');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data Role');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $roles = Role::where('role_id', $role->role_id)->get();
        return ResponseFormater::success($roles, 'Sukses menampilkan data Mapel');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,role_name',
        ]);

        $roles = $request->except(['_token']);
        $roleDB = Role::where('role_id', $role->role_id);
        $updateDB = $roleDB->update($roles);
        if ($updateDB) {
            return ResponseFormater::success($roleDB->get(), 'Sukses memperbarui data Role');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $deleteDB = Role::where('role_id', $role->role_id)->delete();
        if ($deleteDB) {
            return ResponseFormater::success(false, 'Sukses menampilkan data Mapel');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Mapel');
    }
}
