<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required|unique:users,email',
            'user_city' => 'required',
            'user_age' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->messages()]);
        }

        $validator['password'] = Hash::make($request->password);

        $user = User::create($validator);

        return $this->response($user);
    }

    public function updateUser(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => [Rule::unique('users')->ignore($user->id, 'id'), 'email'],
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->messages()]);
        }

        $validator['password'] = Hash::make($request->password);

        User::where('id', $user->id)->update($validator);

        return $this->response($request->user());
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->messages()]);
        }

        if (!Auth::attempt($validator)) {
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
        User::where('email', Auth::user()->email)->update(['active' => 0]);
        Auth::user()->tokens()->delete();
        return response(['message' => 'Anda telah logout'], 200);
    }
}
