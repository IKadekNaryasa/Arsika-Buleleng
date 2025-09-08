<?php

use Illuminate\Support\Facades\Route;


Route::get('/csrf-token', function () {
    return response()->json([
        'token' => csrf_token()
    ]);
})->name('csrf-token');
// Arsip
Route::middleware('web')->group(base_path('routes/arsip.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/auth.php'));
