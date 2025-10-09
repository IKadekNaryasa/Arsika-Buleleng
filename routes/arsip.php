<?php

use App\Http\Controllers\Kaban\ArsipController as KabanArsipController;
use App\Http\Controllers\Operator\ArsipController;
use App\Http\Middleware\ArsikaAuth;
use App\Http\Middleware\ArsikaKaban;
use App\Http\Middleware\ArsikaOperator;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {

    Route::middleware(ArsikaOperator::class)->group(function () {
        Route::resource('arsip', ArsipController::class);
    });


    Route::middleware(ArsikaKaban::class)->group(function () {
        Route::prefix('kbn')->name('kbn.')->group(function () {
            Route::get('arsip/belumLegal', [KabanArsipController::class, 'arsipBelumLegal'])->name('arsip.belumLegal');
            Route::post('arsip/legalisasi', [KabanArsipController::class, 'legalisasi'])->name('arsip.legalisasi');
            Route::resource('arsip', KabanArsipController::class);
        });
    });
    // kaban
});
