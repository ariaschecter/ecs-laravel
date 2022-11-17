<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ResponseFormater;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdatePasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $validator = $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return ResponseFormater::error(false, 'gagal ubah password!, old password salah');
        }
        if ($request->password == $request->old_password) {
            return ResponseFormater::error(false, 'gagal ubah password! password baru tidak boleh sama dengan password lama');
        }
        $validator['password'] = Hash::make($request->password);
        unset($validator['old_password'], $validator['password_confirmation']);
        User::where('id', Auth::user()->id)->update($validator);

        return ResponseFormater::success(true, 'Succes update password');
    }
}
