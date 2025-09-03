<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthLogin extends Controller
{
    public function index()
    {
        return view('auth.login')->with('error', "You're Unauthorized!");
    }
}
