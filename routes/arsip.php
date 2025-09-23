<?php

use App\Http\Controllers\Operator\ArsipController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::resource('arsip', ArsipController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
