<?php

use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserActivationController;

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('user', UserController::class);
    });
});

Route::get('/user/activate/{token}', [UserActivationController::class, 'activate'])
    ->name('user.activate');
