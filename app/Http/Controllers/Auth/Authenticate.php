<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class Authenticate extends Controller
{

    public function authentication(Request $request)
    {
        $sanitize = [
            'email' => e($request->input('email')),
            'password' => e($request->input('password')),
            'g-recaptcha-response' => $request->input('g-recaptcha-response'),
        ];

        $messages = [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address must be a valid email format.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Your password must be at least :min characters long.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha verification failed. Please try again.',
        ];

        $validator = Validator::make($sanitize, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ], $messages)->validate();

        try {
            $user = User::where('email', $validator['email'])
                ->where('status', 'active')
                ->first();

            if (!$user) {
                return back()->withErrors([
                    'errors' => 'The provided credentials do not match our records.',
                ])->withInput($request->only('email'));
            }

            if ($user->loggedIn == true) {
                return back()->withErrors([
                    'errors' => 'This account is already logged in on another device!',
                ])->withInput($request->only('email'));
            }

            $credential = [
                'email' => $validator['email'],
                'password' => $validator['password'],
                'status' => 'active'
            ];

            if (Auth::attempt($credential)) {
                $request->session()->regenerate();

                $authenticatedUser = Auth::user();
                $route = '';

                switch ($authenticatedUser->role) {
                    case 'operator':
                        $route = 'dashboard';
                        break;
                    case 'legalizer':
                        $route = 'legalizer.dashboard';
                        break;
                    case 'admin':
                        $route = 'admin.dashboard';
                        break;
                    default:
                        Auth::logout();
                        return redirect()->route('login')->withErrors(['errors' => 'Invalid Credential!']);
                }

                User::where('id', $authenticatedUser->id)->update(['loggedIn' => true]);

                return redirect()->intended(route($route))->with('success', 'Login Success!');
            }

            return back()->withErrors([
                'errors' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
        } catch (Exception $e) {
            return back()->withErrors([
                'errors' => 'An error occurred. Please try again.',
            ])->withInput($request->only('email'));
        }
    }
    public function logout(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            $loggedInUser = User::find($userId);
            $loggedInUser->update(['loggedIn' => false]);
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Anda telah logout');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Failed to logout, try again!']);
        }
    }
}
