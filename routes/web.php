<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FranchiseController;

// Admin Controllers
use App\Http\Controllers\Admin\FranchiseAdminController;
use App\Http\Controllers\Admin\UserManagementController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

/* ABOUT */
Route::prefix('about')->group(function () {
    Route::view('/pinnacle', 'about.pinnacle')->name('about.pinnacle');
    Route::view('/why', 'about.why')->name('about.why');
    Route::view('/franchise', 'about.franchise')->name('about.franchise');
    Route::view('/clients', 'about.clients')->name('about.clients');
});

/* OUR SERVICES */
Route::view('/our_service', 'our_service.our_service')->name('our_service');

/* CONTACT */
Route::view('/contact', 'contact.contact')->name('contact');

/* FRANCHISABILITY */
Route::prefix('franchisability')->group(function () {
    Route::view('/8_keys', 'franchisability.8_keys')->name('franchisability.keys');
    Route::view('/franchise_test', 'franchisability.franchise_test')->name('franchisability.test');
    Route::view('/franchising_checklist', 'franchisability.franchising_checklist')->name('franchisability.checklist');
});

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/user-dashboard', 'user-dashboard.dashboard')->name('dashboard');

    Route::view('/user-dashboard/ordering-supplies', 'user-dashboard.ordering-supplies.ordering-supplies')
        ->name('ordering.supplies');

    Route::view('/user-dashboard/uploading-requirements', 'user-dashboard.uploading-requirements.uploading-requirements')
        ->name('uploading.requirements');
});

/*
|--------------------------------------------------------------------------
| FRANCHISE APPLICATION
|--------------------------------------------------------------------------
*/

Route::view('/franchise-application-process', 'franchise-application-process.franchise-application-process')
    ->name('franchise.process');

Route::get('/franchise/application', fn() =>
    view('franchise-application-process.franchise-application-process')
)->name('franchise.form');

Route::post('/franchise/submit', [FranchiseController::class, 'store'])
    ->name('franchise.submit');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (SINGLE LOGIN SYSTEM)
|--------------------------------------------------------------------------
|
| Admin still logs in using /login (Breeze default)
| After login: redirect admin users to /admin
| Normal users → /user-dashboard
|
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin dashboard
    Route::view('/', 'admin.admin')->name('dashboard');

    // Static admin pages
    Route::view('/application', 'admin.application')->name('application');
    Route::view('/supplies', 'admin.supplies')->name('supplies');
    Route::view('/requirements', 'admin.requirements')->name('requirements');

    // Franchise Applications
    Route::get('/applications', [FranchiseAdminController::class, 'index'])->name('applications');
    Route::get('/applications/{id}', [FranchiseAdminController::class, 'show'])->name('applications.show');
    Route::delete('/applications/{id}', [FranchiseAdminController::class, 'destroy'])->name('applications.destroy');

    // User accounts management
    Route::get('/users-account', [UserManagementController::class, 'index'])->name('users-account');
    Route::delete('/users-account/{id}', [UserManagementController::class, 'destroy'])->name('users-account.destroy');
});

/*
|--------------------------------------------------------------------------
| USER LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/user/logout', function (Request $request) {

    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');

})->name('custom.logout');

/*
|--------------------------------------------------------------------------
| USER PROFILE SETTINGS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
