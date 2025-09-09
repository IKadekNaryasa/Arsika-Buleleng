<?php

use App\Http\Middleware\ArsikaAuth;
use App\Http\Middleware\ArsikaGuest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLogin;
use App\Http\Controllers\Auth\Authenticate;
use App\Http\Controllers\VerificationController;

Route::middleware(ArsikaGuest::class)->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');



    Route::get('login', [AuthLogin::class, 'index'])->name('login');
    Route::get('/', [AuthLogin::class, 'index'])->name('login');
    Route::post('authentication', [Authenticate::class, 'authentication'])->name('auth.authentication');
});

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::get('logout', [Authenticate::class, 'logout'])->name('auth.logout');
});
