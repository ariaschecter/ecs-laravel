<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'user_name' => 'required',
            'email' => 'required|unique:users,email',
            'user_city' => 'required',
            'user_age' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required',
        ]);

        $validateData['password'] = Hash::make($request->password);

        $user = User::create($validateData);

        return response(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'User ini tidak Terdaftar, silahkan cek kembali!'], 400);
        }
        $active = auth()->user()->active = 1;
        User::where('email', auth()->user()->email)->update(['active' => $active]);

        return response(['user' => auth()->user()]);
    }
}
