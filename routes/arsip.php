<?php

use App\Http\Controllers\Legalizer\ArsipController as LegalizerArsipController;
use App\Http\Controllers\Operator\ArsipController;
use App\Http\Middleware\ArsikaAuth;
use App\Http\Middleware\ArsikaLegalizer;
use App\Http\Middleware\ArsikaOperator;
use Illuminate\Support\Facades\Route;

Route::middleware(ArsikaAuth::class)->group(function () {

    Route::middleware(ArsikaOperator::class)->group(function () {
        Route::post('arsip/cetak', [ArsipController::class, 'cetak'])->name('arsip.cetak');
        Route::resource('arsip', ArsipController::class);
    });


    Route::middleware(ArsikaLegalizer::class)->group(function () {
        Route::prefix('legalizer')->name('legalizer.')->group(function () {
            Route::get('arsip/belumLegal', [LegalizerArsipController::class, 'arsipBelumLegal'])->name('arsip.belumLegal');
            Route::post('arsip/legalisasi', [LegalizerArsipController::class, 'legalisasi'])->name('arsip.legalisasi');
            Route::resource('arsip', LegalizerArsipController::class);
        });
    });
});
