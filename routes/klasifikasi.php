<?php

use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\KodeKlasifikasiController;
use App\Http\Controllers\Operator\ArsipController;
use App\Http\Middleware\ArsikaAdmin;
use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {

    // Admin
    Route::middleware(ArsikaAdmin::class)->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('klasifikasi', KodeKlasifikasiController::class)->only(['index', 'create', 'edit', 'update', 'store']);
        });
    });
});
