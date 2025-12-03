<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

//about 
Route::get('/about/pinnacle', function () {
    return view('about.pinnacle');
});

Route::get('/about/why', function () {
    return view('about.why');
});

Route::get('/about/franchise', function () {
    return view('about.franchise');
});

Route::get('/about/clients', function () {
    return view('about.clients');
});

//our services
Route::get('/about', function () {
    return view('about.pinnacle');
});

Route::get('/about', function () {
    return view('about.why');
});

Route::get('/about', function () {
    return view('about.franchise');
});

Route::get('/about', function () {
    return view('about.clients');
});

//our services
Route::get('/our_service', function () {
    return view('our_service.our_service');
});
//contuct us
Route::get('/contact', function () {
    return view('contact.contact');
});

//franchissability 
Route::get('/franchisability/8_keys', function () {
    return view('franchisability.8_keys');
});
Route::get('/franchisability/franchise_test', function () {
    return view('franchisability.franchise_test');
});
Route::get('/franchisability/franchising_checklist', function () {
    return view('franchisability.franchising_checklist');
});

//ordering supplies
Route::get('/user-dashboard/ordering-supplies', function () {
    return view('user-dashboard.ordering-supplies.ordering-supplies');
})->name('ordering.supplies');

Route::get('/user-dashboard/uploading-requirements', function () {
    return view('user-dashboard.uploading-requirements.uploading-requirements');
})->name('uploading.requirements');

Route::get('/franchise-application-process', function () {
    return view('/franchise-application-process/franchise-application-process');
})->name('franchise.process');


// Dashboard for normal users
Route::get('/user-dashboard', function () {
    return view('user-dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//admin
Route::view('/admin/admin', 'admin.admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.admin');


//logout
Route::post('/user/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('custom.logout');


// Redirect users based on usertype
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Profile routes (only once)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


