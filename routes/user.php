<?php

use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserActivationController;
use App\Http\Middleware\ArsikaAdmin;

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::middleware(ArsikaAdmin::class)->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::put('user/update/{user}', [UserController::class, 'setStatus'])->name('user.setStatus');
            Route::resource('user', UserController::class);
        });
    });
});

Route::get('/user/activate/{token}', [UserActivationController::class, 'activate'])
    ->name('user.activate');
