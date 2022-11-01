<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function response($user)
    {
        $token = $user->createToken(str()->random(30))->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
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

        return $this->response($user);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'User ini tidak Terdaftar, silahkan cek kembali!'], 401);
        }

        $user = Auth::user();

        if ($user->active == 1) {
            return response(['message' => 'User ini sedang aktif!!! tidak bisa login'], 400);
        }

        User::where('email', Auth::user()->email)->update(['active' => 1]);
        $user->active = 1;

        return $this->response($user);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        User::where('email', Auth::user()->email)->update(['active' => 0]);
        return response(['message' => 'Anda telah logout'], 200);
    }
}
