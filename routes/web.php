<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Kaban\DashboardController as KabanDashboardController;


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('kbn/dashboard', [KabanDashboardController::class, 'index'])->name('kbn.dashboard');

// Arsip
Route::middleware('web')->group(base_path('routes/arsip.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/auth.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/user.php'));
