<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HR\ClaimController;
use App\Http\Controllers\Portal\HrDashboardController;

Route::middleware(['web', 'auth', 'role:portal'])->group(function () {
    Route::get('/portal/dashboard', [HrDashboardController::class, 'index'])
        ->name('portal.dashboard');

    Route::post('/hr/claims', [ClaimController::class, 'store'])
        ->name('hr.claims.store');

    Route::get('/hr/claims/check-duplicate', [ClaimController::class, 'checkDuplicate'])
        ->name('hr.claims.checkDuplicate');

    Route::get('/hr/claims/{claim}', [ClaimController::class, 'show'])
        ->name('hr.claims.show');

    Route::get('/hr/claims/{claim}/analysis', [ClaimController::class, 'analysis'])
        ->name('hr.claims.analysis');

    Route::delete('/hr/claims/{claim}', [ClaimController::class, 'destroy'])
        ->name('hr.claims.destroy');

    Route::post('/claims/{claim}/recompute', [ClaimController::class, 'requestRecompute'])
        ->name('claims.recompute');
});