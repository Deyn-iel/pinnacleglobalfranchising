<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ContactController;

Route::get('/redirect-after-login', function () {
    $user = Auth::user();

    if ($user->usertype === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->usertype === 'supplies') {
        return redirect()->route('supplies.supplies-dashboard');
    }

    if ($user->usertype === 'ticket') {
        return redirect()->route('tickets.dashboard');
    }

    return redirect()->route('dashboard');
})->middleware('auth');

Route::prefix('about')->group(function () {
    Route::view('/pinnacle', 'about.pinnacle')->name('about.pinnacle');
    Route::view('/why', 'about.why')->name('about.why');
    Route::view('/franchise', 'about.franchise')->name('about.franchise');
    Route::view('/clients', 'about.clients')->name('about.clients');
});

Route::view('/our_service', 'our_service.our_service')->name('our_service');
Route::view('/contact', 'contact.contact')->name('contact');

Route::prefix('franchisability')->group(function () {
    Route::view('/8_keys', 'franchisability.8_keys')->name('franchisability.keys');
    Route::view('/franchise_test', 'franchisability.franchise_test')->name('franchisability.test');
    Route::view('/franchising_checklist', 'franchisability.franchising_checklist')->name('franchisability.checklist');
});

Route::view('/franchise-application-process', 'franchise-application-process.franchise-application-process')
    ->name('franchise.process');

Route::view('/franchise-patatas-process', 'franchise-application-process.franchise-patatas-process')
    ->name('patatas.process');

Route::get('/franchise/application', fn () =>
    view('franchise-application-process.franchise-application-process')
)->name('franchise.form');

Route::post('/franchise/submit', [FranchiseController::class, 'store'])
    ->name('franchise.submit');

Route::get('/ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse=ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse=ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse', [ExamController::class, 'select'])
    ->name('exam.select');

Route::post('/exam/submit', [ExamController::class, 'submit'])
    ->name('exam.submit');

Route::post('/exam/save-progress', [ExamController::class, 'saveProgress'])
    ->name('exam.saveProgress');

Route::post('/contact/send', [ContactController::class, 'store'])
    ->name('contact.send');

Route::post('/user/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('custom.logout');