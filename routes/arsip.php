<?php

use App\Http\Controllers\Admin\ArsipController;
use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::resource('arsip', ArsipController::class);
});
