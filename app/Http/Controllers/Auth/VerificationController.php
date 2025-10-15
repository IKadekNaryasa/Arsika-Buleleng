<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan Login!');
    }
}
