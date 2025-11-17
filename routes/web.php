<?php

use Illuminate\Support\Facades\Route;
// Arsip
Route::middleware('web')->group(base_path('routes/arsip.php'));
// Bidang
Route::middleware('web')->group(base_path('routes/bidang.php'));
// Authentication
Route::middleware('web')->group(base_path('routes/auth.php'));
// Authentication
Route::middleware('web')->group(base_path('routes/user.php'));
