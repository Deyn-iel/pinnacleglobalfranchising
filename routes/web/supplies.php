<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliesDashboardController;

Route::middleware(['auth', 'role:supplies'])->group(function () {
    Route::get('/supplies/dashboard', [SuppliesDashboardController::class, 'index'])
        ->name('supplies.supplies-dashboard');
});