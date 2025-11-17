<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Legalizer\DashboardController as LegalizerDashboardController;
use App\Http\Middleware\ArsikaAdmin;
use App\Http\Middleware\ArsikaAuth;
use App\Http\Middleware\ArsikaLegalizer;
use App\Http\Middleware\ArsikaOperator;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(ArsikaAuth::class, ArsikaOperator::class);
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(ArsikaAuth::class, ArsikaAdmin::class);
Route::get('legalizer/dashboard', [LegalizerDashboardController::class, 'index'])->name('legalizer.dashboard')->middleware(ArsikaAuth::class, ArsikaLegalizer::class);

// Arsip
Route::middleware('web')->group(base_path('routes/arsip.php'));
// Bidang
Route::middleware('web')->group(base_path('routes/bidang.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/auth.php'));

// Authentication
Route::middleware('web')->group(base_path('routes/user.php'));
