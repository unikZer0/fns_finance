<?php

use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────────────────────────
// Role-based Dashboard Routes
// ─────────────────────────────────────────────────────────────────

// 1. Admin
Route::middleware(['auth', 'check.active', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::resource('departments', \App\Http\Controllers\Admin\DepartmentController::class);
        Route::resource('chart-of-accounts', \App\Http\Controllers\Admin\ChartOfAccountController::class);
    });

// 2. Finance Head
Route::middleware(['auth', 'check.active', 'role:head_of_finance'])
    ->prefix('head-of-finance')
    ->name('head_of_finance.')
    ->group(function () {
        Route::get('/home', [\App\Http\Controllers\FinanceHead\HomeController::class, 'index'])->name('home');
    });

// 3. Faculty Head
Route::middleware(['auth', 'check.active', 'role:head_of_faculty'])
    ->prefix('head-of-faculty')
    ->name('head_of_faculty.')
    ->group(function () {
        Route::get('/home', [\App\Http\Controllers\FacultyHead\HomeController::class, 'index'])->name('home');
    });

// 4. Faculty Deputy
Route::middleware(['auth', 'check.active', 'role:deputy_head_of_faculty'])
    ->prefix('deputy-head-of-faculty')
    ->name('deputy_head_of_faculty.')
    ->group(function () {
        Route::get('/home', [\App\Http\Controllers\FacultyDeputy\HomeController::class, 'index'])->name('home');
    });

// 5. Accountant
Route::middleware(['auth', 'check.active', 'role:accountant'])
    ->prefix('accountant')
    ->name('accountant.')
    ->group(function () {
        Route::get('/home', [\App\Http\Controllers\Accountant\HomeController::class, 'index'])->name('home');
    });
