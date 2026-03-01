<?php

// routes/admin.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'admin' can access these.
// Your friend working on admin features edits THIS file.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // CRUD Resources
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('chart-of-accounts', ChartOfAccountController::class);
    });
