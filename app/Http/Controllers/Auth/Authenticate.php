<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Authenticate extends Controller
{
    public function authentication(Request $request)
    {
        $sanitize = [
            'email' => e($request->input('email')),
            'password' => e($request->input('password'))
        ];

        $credential = Validator::make($sanitize, [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:8']
        ])->validate();

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user) {
                Auth::logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed Authentication'
                ], 401);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Authentication Success',
                    'user' => $user
                ]);
            }
            return redirect()->intended(route('arsip.index'))->with('success', 'Loggin Success!');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Username or Password'
            ], 401);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout');
    }
}
