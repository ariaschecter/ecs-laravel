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
    public function response($user, $message)
    {
        $token = $user->createToken(str()->random(30))->plainTextToken;
        $dataWithToken = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ];
        return ResponseFormater::success($dataWithToken, $message);
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

        if ($request) {
            User::create($user);
            return $this->response($user, 'Registration Succes');
        }

        return ResponseFormater::error($user, 'Register Gagal', 400);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validate)) {
            return ResponseFormater::error(false, 'User ini tidak Terdaftar, silahkan cek kembali!', 401);
        }

        $user = Auth::user();

        if ($user->active == 1) {
            return ResponseFormater::error(false, 'User ini sedang aktif!!! tidak bisa login', 400);
        }

        if (!$user) {
            return ResponseFormater::error($user, 'Gagal Login', 400);
        }
        User::where('email', $user->email)->update(['active' => 1]);
        $user->active = 1;

        return $this->response($user, 'Login Success');
    }

    public function showUser(Request $request)
    {
        return ResponseFormater::success($request->user(), 'User sedang login');
    }

    public function updateUser(Request $request, User $user)
    {
        $validate =
            $request->validate([
                'user_name' => 'required',
                'email' => [Rule::unique('users')->ignore($user->id, 'id'), 'email'],
            ]);

        $validate['password'] = Hash::make($request->password);
        $userDB = User::where('id', $user->id);
        $updateDB = $userDB->update($validate);
        unset($validate['password']);

        if ($updateDB) {
            return ResponseFormater::success($userDB->get(), 'User berhasil diperbarui');
        }
        return ResponseFormater::error($validate, 'User gagal diperbarui');
    }

    public function logout()
    {
        User::where('email', Auth::user()->email)->update(['active' => 0]);
        Auth::user()->tokens()->delete();
        return ResponseFormater::success(false, 'Anda telah logout');
    }
}
