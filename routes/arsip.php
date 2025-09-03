<?php

use App\Http\Controllers\Admin\ArsipController;
use Illuminate\Support\Facades\Route;

Route::resource('arsip', ArsipController::class)->middleware('auth');
