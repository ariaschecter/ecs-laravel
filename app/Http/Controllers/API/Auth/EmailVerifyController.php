<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ResponseFormater;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function notice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ResponseFormater::success($request->all(), 'Already Verified');
        }
        return ResponseFormater::error(false, 'verifikasi email anda!!!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ResponseFormater::error(false, 'Already Verified', 400);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return view('email_verify.index');
    }

    public function send(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ResponseFormater::error(false, 'Already Verified', 400);
        }
        $request->user()->sendEmailVerificationNotification();
        return ResponseFormater::success(true, 'Verifikasi email berhasil dikirim');
    }
}
