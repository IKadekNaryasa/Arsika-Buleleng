<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    public function resend(Request $request)
    {
        $user = Auth::user();
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        Mail::to($user->email)->send(new VerifyEmail($user));

        return back()->with('success', 'Tautan verifikasi telah dikirim ulang!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan Login!');
    }
}
