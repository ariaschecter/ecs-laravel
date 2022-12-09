<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ResponseFormater;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function notice(Request $request)
    {
        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            return ResponseFormater::success($user, 'Already Verified');
        }
        return ResponseFormater::error(false, 'verifikasi email anda!!!');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            return ResponseFormater::error(false, 'Already Verified', 400);
        }
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return ResponseFormater::error(false, 'Verify failed', 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return view('email_verify.index')->with('id', $request->route('id'));
    }

    public function send(Request $request)
    {
        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            return ResponseFormater::error(false, 'Already Verified', 400);
        }
        $user->sendEmailVerificationNotification();
        return ResponseFormater::success(true, 'Verifikasi email berhasil dikirim');
    }
}
