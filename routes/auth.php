<?php

use App\Http\Controllers\Auth\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLogin;


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthLogin::class, 'index'])->name('login')->middleware('guest');
    Route::get('/', [AuthLogin::class, 'index'])->name('login')->middleware('guest');
    Route::post('authentication', [Authenticate::class, 'authentication'])->name('auth.authentication')->middleware('guest');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [Authenticate::class, 'logout'])->name('auth.logout')->middleware('auth');
});
