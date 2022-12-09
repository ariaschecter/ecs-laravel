<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ResponseFormater;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Payment;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'user_city' => 'required',
            'user_age' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required',

            'payment_price' => 'required',
            'payment_picture' => 'required|file|image|max:5120',
            'payment_method_id' => 'required',
        ]);

        $request['password'] = Hash::make($request->password);
        $user = $request->only(['name', 'email', 'user_city', 'user_age', 'password', 'role_id']);
        $register = User::create($user);

        $payment_picture = $request->file('payment_picture')->store('img/payment');
        $payment = [
            'payment_method_id' => $request->payment_method_id,
            'id' => $register->id,
            'payment_ref' => Str::upper(Str::random(14)),
            'payment_picture' => $payment_picture,
            'payment_price' => $request->payment_price,
            'payment_status' => 'PENDING',
        ];

        Payment::create($payment);

        if ($register) {
            event(new Registered($register)); //send email verification

            $token = $register->createToken('token')->plainTextToken;
            $cookie = cookie('jwt', $token, 60 * 24, null, null, false, false);

            return ResponseFormater::success($register, 'Registrasi Berhasil silahkan login', $token)->withCookie($cookie);
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
            return ResponseFormater::error(false, 'Email atau Password salah!!, silahkan cek kembali!', Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        if ($user->role_id == 1) {
            return ResponseFormater::error(false, 'Gagal Login');
        }
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24, null, null, false, false);

        return ResponseFormater::success($user, 'Login Success', $token)->withCookie($cookie);
    }

    public function showUser(Request $request)
    {
        return ResponseFormater::success(Auth::user(), 'berhasil menampilkan users');
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'user_picture' => 'file|image|max:5120',
            'user_city' => 'required',
            'user_age' => 'required',
        ]);

        $upload = 'img/profile/default.png';
        $picture = $user->user_picture;

        if ($request->user_picture) {
            if ($picture != $upload) {
                Storage::delete($user->user_picture);
            }
            $picture = $request->file('user_picture')->store('img/profile');
        }

        $update = $request->only(['name', 'user_city', 'user_age']);
        $update['user_picture'] = $picture;

        $userDB = User::where('id', $user->id);
        $updateDB = $userDB->update($update);

        if ($updateDB) {
            return ResponseFormater::success($userDB->get(), 'User berhasil diperbarui');
        }
        return ResponseFormater::error(false, 'User gagal diperbarui');
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        $cookie = Cookie::forget('jwt');
        return ResponseFormater::success(true, 'Logout success')->withCookie($cookie);
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
