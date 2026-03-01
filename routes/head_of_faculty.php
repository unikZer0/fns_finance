<?php

// routes/head_of_faculty.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'head_of_faculty' can access these.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\HeadOfFaculty\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:head_of_faculty'])
    ->prefix('head-of-faculty')
    ->name('head_of_faculty.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Add more head_of_faculty routes here
    });
