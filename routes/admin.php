<?php

// routes/admin.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'admin' can access these.
// Your friend working on admin features edits THIS file.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Add more admin routes here, e.g.:
        // Route::resource('users', UserController::class);
    });
