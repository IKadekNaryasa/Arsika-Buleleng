<?php

use App\Http\Controllers\Auth\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLogin;
use App\Http\Middleware\ArsikaAuth;
use App\Http\Middleware\ArsikaGuest;

Route::middleware(ArsikaGuest::class)->group(function () {
    Route::get('login', [AuthLogin::class, 'index'])->name('login');
    Route::get('/', [AuthLogin::class, 'index'])->name('login');
    Route::post('authentication', [Authenticate::class, 'authentication'])->name('auth.authentication');
});

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::get('logout', [Authenticate::class, 'logout'])->name('auth.logout');
});
