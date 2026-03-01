<?php

// routes/accountant.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'accountant' can access these.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\Accountant\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:accountant'])
    ->prefix('accountant')
    ->name('accountant.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Add more accountant routes here
    });
