<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
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
        $register = User::create($user);

        if ($register) {
            $data = User::where('email', $request->email)->get();
            return ResponseFormater::success($data, 'Registration Succes');
        }

        return ResponseFormater::error($user, 'Register Gagal', 400);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $userDB = User::where('email', $request->email)->get();

        if (count($userDB) > 0) {
            if ($userDB[0]['active'] == 0 && $userDB[0]['role_id'] > 1) {
                return ResponseFormater::error(false, 'Email belum diverivikasi');
            }
        }

        if (!Auth::attempt($validate)) {
            return ResponseFormater::error(false, 'User ini tidak Terdaftar, silahkan cek kembali!', Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);

        if (!$user) {
            return ResponseFormater::error(false, 'Gagal Login', 400);
        }

        return ResponseFormater::success($user, 'Login Success')->withCookie($cookie);
    }

    public function showUser(Request $request)
    {
        return ResponseFormater::success(Auth::user(), 'User sedang login');
    }

    public function updateUser(Request $request, User $user)
    {
        $validate =
            $request->validate([
                'user_name' => ['required', Rule::unique('users')->ignore($user->id, 'id')],
                'email' => ['required', Rule::unique('users')->ignore($user->id, 'id'), 'email'],
                'user_city' => 'required',
                'user_age' => 'required',
                'role_id' => 'required',
            ]);
        // if ($request->password) {
        $validate['password'] = Hash::make($request->password);
        // }
        $userDB = User::where('id', $user->id);
        $updateDB = $userDB->update($validate);
        unset($validate['password']);

        if ($updateDB) {
            return ResponseFormater::success($userDB->get(), 'User berhasil diperbarui');
        }
        return ResponseFormater::error(false, 'User gagal diperbarui');
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        Auth::user()->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ])->withCookie($cookie);
    }

    public function destroy(User $user)
    {
        $deleteDB = User::where('id', $user->id)->delete();
        if ($deleteDB) {
            return ResponseFormater::success(true, 'User berhasil hapus');
        }
        return ResponseFormater::error(false, 'User gagal hapus');
    }
}
