<?php

use App\Http\Controllers\Kaban\ArsipController as KabanArsipController;
use App\Http\Controllers\Operator\ArsipController;
use App\Http\Middleware\ArsikaAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {
    Route::resource('arsip', ArsipController::class);


    // kaban
    Route::prefix('kbn')->name('kbn.')->group(function () {
        Route::get('arsip/belumLegal', [KabanArsipController::class, 'arsipBelumLegal'])->name('arsip.belumLegal');
        Route::post('arsip/legalisasi', [KabanArsipController::class, 'legalisasi'])->name('arsip.legalisasi');
        Route::resource('arsip', KabanArsipController::class);
    });
});
