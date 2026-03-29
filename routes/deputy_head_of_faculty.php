<?php

// routes/deputy_head_of_faculty.php
// ─────────────────────────────────────────────────────
// Only users with role_name = 'deputy_head_of_faculty' can access these.
// ─────────────────────────────────────────────────────

use App\Http\Controllers\DeputyHeadOfFaculty\HomeController;
use App\Http\Controllers\DeputyHeadOfFaculty\BudgetReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check.active', 'role:deputy_head_of_faculty'])
    ->prefix('deputy-head-of-faculty')
    ->name('deputy_head_of_faculty.')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/annual-budget', [BudgetReviewController::class, 'index'])->name('annual-budget.index');
        Route::get('/annual-budget/{annualBudget}', [BudgetReviewController::class, 'show'])->name('annual-budget.show');
        Route::post('/annual-budget/{annualBudget}/review', [BudgetReviewController::class, 'review'])->name('annual-budget.review');
    });
