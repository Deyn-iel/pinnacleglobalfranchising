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
use App\Http\Controllers\AdminExamController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ExamController;
use App\Models\Contact;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminExamResultController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SuppliesDashboardController;
use App\Http\Controllers\Admin\SupplyController;
use App\Http\Controllers\Admin\AdminSuppliesController;


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/


Route::view('/', 'welcome')->name('home');

Route::get('/redirect-after-login', function () {
    $user = Auth::user();

    if ($user->usertype === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->usertype === 'supplies') {
        return redirect()->route('supplies.supplies-dashboard');
    }

    return redirect()->route('dashboard'); // normal user
})->middleware('auth');



//suppliesss///////////////////////////////////////////////
Route::middleware(['auth', 'role:supplies'])->group(function () {
    Route::get('/supplies/dashboard', [SuppliesDashboardController::class, 'index'])
        ->name('supplies.supplies-dashboard');
});
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

Route::middleware(['auth'])->group(function () {
    Route::post('/attendance/log', [AttendanceController::class, 'log'])
        ->name('attendance.log');
});

Route::post('/exam/save-progress', [ExamController::class, 'saveProgress'])
    ->name('exam.saveProgress');

Route::middleware(['auth', 'verified'])->group(function () {

        

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    

    

    Route::view(
        '/user-dashboard/uploading-requirements',
        'user-dashboard.uploading-requirements.uploading-requirements'
    )->name('uploading.requirements');
    

    /* ✅ EXAM – MUST USE CONTROLLER */
    Route::get('/I%2jdawh=adwIpkadLHiadw0476jhJ/{exam}', [ExamController::class, 'start'])
    ->name('exam.start');

    Route::view(
        '/dwajn0938UIHi&*65wauhunotificationawduhygy6wedag',
        'user-dashboard.notification.notification'
    )->name('notification');

    Route::view(
        '/Pjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90)daiu',
        'user-dashboard.attendance.attendance'
    )->name('attendance');

    /* ✅ PROCEED – STATIC PAGE */
    Route::view(
        '/adw6daid7ad97w8ydawd3acr3rarvavr53a3',
        'user-dashboard.exam.proceed'
    )->name('proceed');

    Route::view(
        '/hauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJd',
        'user-dashboard.exam.video'
    )->name('video');

    Route::view(
        '/adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=',
        'user-dashboard.exam.exam-done'
    )->name('exam-done');
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





// show list of available exams
Route::get('/ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse', [ExamController::class, 'select'])
    ->name('exam.select');


Route::post('/exam/submit', [ExamController::class, 'submit'])
    ->name('exam.submit');


Route::get('/admin/exams/{id}/edit', [AdminExamController::class, 'edit'])
    ->name('admin.exams.edit');

Route::put('/admin/exams/{id}', [AdminExamController::class, 'update'])
    ->name('admin.exams.update');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/admin-profile', function () {
        return view('admin.admin-profile.edit', [
            'user' => Auth::user()
        ]);
    })->name('admin.admin-profile.edit');
});


Route::middleware(['auth', 'admin', 'admin.desktop'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    
    // SUPPLIES MANAGEMENT 
     Route::get('/supplies', [AdminSuppliesController::class, 'index'])
            ->name('supplies');

        Route::post('/supplies', [AdminSuppliesController::class, 'store'])
            ->name('supplies.store');



Route::get('/supplies/{supply}/edit', [AdminSuppliesController::class, 'edit'])
    ->name('supplies.edit');

Route::put('/supplies/{supply}', [AdminSuppliesController::class, 'update'])
    ->name('supplies.update');

Route::delete('/supplies/{supply}', [AdminSuppliesController::class, 'destroy'])
    ->name('supplies.destroy');



    Route::post('/attendance/location', [AdminAttendanceController::class, 'updateLocation'])
    ->name('attendance.location.update');

    Route::patch(
    '/exams/{exam}/toggle',
    [AdminExamController::class, 'toggle']
)->name('exams.toggle');


    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::put(
    '/attendance/{attendance}',
    [AdminAttendanceController::class, 'update']
)->name('attendance.update');


    Route::get('/attendance/export', [AdminAttendanceController::class, 'exportRange'])
    ->name('attendance.export');

    Route::delete('/attendance/{id}', 
    [AdminAttendanceController::class, 'destroy']
)->name('attendance.destroy');

Route::get('/attendance', [AdminAttendanceController::class, 'index'])
            ->name('attendance');

        // VIEW EXAM RESULT DETAILS
    Route::get('/exam-results/{id}', [AdminExamResultController::class, 'show'])
        ->name('exam-results.view');

        // VIEW EXAM RESULTS
        Route::get('/exam-results', [AdminExamResultController::class, 'results'])
            ->name('exam-results');

        Route::delete('/exam-results/{id}', [AdminExamResultController::class, 'destroy'])
            ->name('exam-results.delete');

        // User management
        Route::get('/users-account', [UserManagementController::class, 'index'])
            ->name('users-account');

        Route::delete('/users-account/{id}', [UserManagementController::class, 'destroy'])
            ->name('users-account.destroy');

       // Show register form
        Route::get('/users/register', [AdminUserController::class, 'create'])
            ->name('users.register');

        // Handle register submit
        Route::post('/users/register', [AdminUserController::class, 'store'])
            ->name('users.store');


        /* ===============================
         * ADMIN DASHBOARD STATIC PAGES
         * =============================== */

        Route::view('/', 'admin.admin')->name('dashboard');
        Route::view('/application', 'admin.application')->name('application');

        Route::get('/requirements', [RequirementController::class, 'index'])
    ->name('requirements');

    Route::delete('/requirements/{id}', 
    [RequirementController::class, 'destroy']
)->name('requirements.delete');





Route::post('/requirements', [RequirementController::class, 'store']);


        /* ⚠️ IMPORTANT:
           Removed the WRONG route:
           Route::view('/uploading-exams', 'admin.uploading-exams')->name('uploading-exams');
           (This caused $exams = undefined)
        */


        /* ===============================
         * EXAM MANAGEMENT (CONTROLLER)
         * =============================== */

        // Display Upload Exams Page
        Route::get('/uploading-exams', [AdminExamController::class, 'index'])
            ->name('uploading-exams');

        // Save Exam
        Route::post('/exams/store', [AdminExamController::class, 'store'])
            ->name('exams.store');

        // Delete Exam
        Route::delete('/exams/delete/{id}', [AdminExamController::class, 'delete'])
            ->name('exams.delete');


        /* ===============================
         * FRANCHISE APPLICATIONS
         * =============================== */

        Route::get('/applications', [FranchiseAdminController::class, 'index'])
            ->name('applications');

        Route::get('/applications/{id}', [FranchiseAdminController::class, 'show'])
            ->name('applications.show');

        Route::delete('/applications/{id}', [FranchiseAdminController::class, 'destroy'])
            ->name('applications.destroy');


        /* ===============================
         * USER ACCOUNT MANAGEMENT
         * =============================== */

        Route::get('/users-account', [UserManagementController::class, 'index'])
            ->name('users-account');

        

           /* CONTACT LIST */
Route::get('/contacts', function () {
    $contacts = \App\Models\Contact::latest()->get();
    return view('admin.contacts', compact('contacts'));
})->name('contacts');

/* ✅ DELETE ALL — MUST BE FIRST */
Route::delete('/contacts/delete-all', function () {
    \App\Models\Contact::truncate();

    return redirect()
        ->route('admin.contacts')
        ->with('success', 'All contact messages have been deleted.');
})->name('contacts.deleteAll');

/* DELETE SINGLE — MUST BE LAST */
Route::delete('/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'destroy'])
    ->name('contacts.delete');



    });

//contact
Route::post('/contact/send', [ContactController::class, 'store'])
    ->name('contact.send');
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

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('admin.profile.edit');

    Route::patch('/profile', [ProfileController::class, 'updateAll'])
        ->name('admin.profile.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/update-all', 
    [\App\Http\Controllers\ProfileController::class, 'updateAll']
    )->name('profile.update.all');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
