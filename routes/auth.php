<?php

use App\Http\Middleware\ArsikaAuth;
use App\Http\Middleware\ArsikaGuest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLogin;
use App\Http\Controllers\Auth\Authenticate;
use App\Http\Controllers\Auth\ChangePassword;
use App\Http\Controllers\Auth\ForgotPassword;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Legalizer\DashboardController as LegalizerDashboardController;
use App\Http\Middleware\ArsikaAdmin;
use App\Http\Middleware\ArsikaLegalizer;
use App\Http\Middleware\ArsikaOperator;

Route::get('/', function () {
    return view('arsika');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(ArsikaAuth::class, ArsikaOperator::class);
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(ArsikaAuth::class, ArsikaAdmin::class);
Route::get('legalizer/dashboard', [LegalizerDashboardController::class, 'index'])->name('legalizer.dashboard')->middleware(ArsikaAuth::class, ArsikaLegalizer::class);


Route::middleware(ArsikaGuest::class)->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::get('/forgot-password', [ForgotPassword::class, 'index'])->name('forgot-password');
    Route::post('auth/forgotPassword', [ForgotPassword::class, 'forgotPassword'])->name('auth.forgotPassword');
    Route::get('auth/reset-password/{token}', [ForgotPassword::class, 'resetPassword'])->name('password.reset');
    Route::post('auth/resetPassword', [ForgotPassword::class, 'reset'])->name('password.update');

    Route::get('login', [AuthLogin::class, 'index'])->name('login');
    Route::post('authentication', [Authenticate::class, 'authentication'])->name('auth.authentication');
});

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::get('logout', [Authenticate::class, 'logout'])->name('auth.logout');

    Route::put('auth/update/{user}', [ChangePassword::class, 'changePassword'])->name('changePassword');
});
