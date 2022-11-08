<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function notice(Request $request)
    {
        return ResponseFormater::success($request->all(), 'Daftar berhasil!, silahkan verifikasi email anda!!!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return ResponseFormater::success(true, 'Email terverifikasi!!!');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerification();
        return ResponseFormater::success(true, 'Verifikasi email berhasil dikirim');
    }
}
