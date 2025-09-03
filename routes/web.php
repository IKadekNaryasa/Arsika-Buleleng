<?php

use Illuminate\Support\Facades\Route;

// Arsip
Route::middleware('web')->group(base_path('routes/arsip.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/auth.php'));
