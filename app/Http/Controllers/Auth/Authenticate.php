<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
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
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ])->validate();

        try {
            if (Auth::attempt($credential)) {
                $request->session()->regenerate();

                $user = Auth::user();

                if (!$user) {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['errors' => 'Invalid Credential!']);
                }

                $role = Auth::user()->role;
                $route = '';

                switch ($role) {
                    case 'operator':
                        $route = 'dashboard';
                        break;
                    case 'kepala_badan':
                        $route = 'kbn.dashboard';
                        break;

                    default:
                        Auth::logout();
                }
                return redirect()->intended(route($route))->with('success', 'Loggin Success!');
            }

            if ($request->expectsJson()) {
                return redirect()->route('login')->withErrors(['errors' => 'Invalid Credential!']);
            }

            return back()->withErrors([
                'errors' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
        } catch (Exception $e) {
            return back()->withErrors([
                'errors' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout');
    }
}
