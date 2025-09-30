<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('user', UserController::class);
    });
});
