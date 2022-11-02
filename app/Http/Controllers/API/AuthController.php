<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $request->validate([
            'user_name' => 'required',
            'email' => 'required|unique:users,email',
            'user_city' => 'required',
            'user_age' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required',
        ]);

        $request['password'] = Hash::make($request->password);
        $user = $request->except(['password_confirmation', '_token']);

        User::create($user);

        return response([$user]);
    }

    public function updateUser(Request $request, User $user)
    {
        $validate =
            $request->validate([
                'user_name' => 'required',
                'email' => [Rule::unique('users')->ignore($user->id, 'id'), 'email'],
            ]);

        $validate['password'] = Hash::make($request->password);

        User::where('id', $user->id)->update($validate);

        return response($request);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validate)) {
            return response([
                'message' => 'User ini tidak Terdaftar, silahkan cek kembali!',
            ], 401);
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
        User::where('email', Auth::user()->email)->update(['active' => 0]);
        Auth::user()->tokens()->delete();
        return response(['message' => 'Anda telah logout'], 200);
    }
}
