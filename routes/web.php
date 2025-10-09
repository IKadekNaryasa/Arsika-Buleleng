<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Kaban\DashboardController as KabanDashboardController;
use App\Http\Middleware\ArsikaAdmin;
use App\Http\Middleware\ArsikaKaban;
use App\Http\Middleware\ArsikaOperator;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(ArsikaOperator::class);
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(ArsikaAdmin::class);
Route::get('kbn/dashboard', [KabanDashboardController::class, 'index'])->name('kbn.dashboard')->middleware(ArsikaKaban::class);

// Arsip
Route::middleware('web')->group(base_path('routes/arsip.php'));
// Bidang
Route::middleware('web')->group(base_path('routes/bidang.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/auth.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/user.php'));
