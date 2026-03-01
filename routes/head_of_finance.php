<?php

// routes/head_of_finance.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'head_of_finance' can access these.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\HeadOfFinance\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:head_of_finance'])
    ->prefix('head-of-finance')
    ->name('head_of_finance.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Add more head_of_finance routes here
    });
