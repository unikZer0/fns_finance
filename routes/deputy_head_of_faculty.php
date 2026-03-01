<?php

// routes/deputy_head_of_faculty.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'deputy_head_of_faculty' can access these.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\DeputyHeadOfFaculty\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:deputy_head_of_faculty'])
    ->prefix('deputy-head-of-faculty')
    ->name('deputy_head_of_faculty.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Add more deputy_head_of_faculty routes here
    });
