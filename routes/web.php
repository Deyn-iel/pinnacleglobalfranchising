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
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Hr\PayslipController;
use App\Http\Controllers\SupportChatController;
use App\Http\Controllers\SupportPresenceController;

use App\Http\Controllers\User\CoffeeRegistrationController as UserCoffeeReg;
use App\Http\Controllers\Admin\CoffeeRegistrationController as AdminCoffeeReg;
use App\Http\Controllers\Admin\CoffeeRegistrationController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\Admin\UserEmailController;

use App\Http\Controllers\HR\ClaimController;
use App\Http\Controllers\HR\ClaimController as HRClaimController;
use App\Http\Controllers\Admin\ClaimInboxController;

use App\Http\Controllers\Portal\HrDashboardController;

use App\Http\Controllers\Admin\HeadOfficeTicketController;
use App\Http\Controllers\AnnouncementController;

Route::middleware(['web','auth','role:portal'])->group(function () {

    Route::get('/portal/dashboard', [HrDashboardController::class, 'index'])
        ->name('portal.dashboard'); 

   Route::post('/hr/claims', [ClaimController::class, 'store'])->name('hr.claims.store');

   Route::get('/hr/claims/check-duplicate', [ClaimController::class, 'checkDuplicate'])
    ->name('hr.claims.checkDuplicate');

    Route::get('/hr/claims/{claim}', [ClaimController::class, 'show'])->name('hr.claims.show');

    Route::get('/hr/claims/{claim}/analysis', [ClaimController::class, 'analysis'])->name('hr.claims.analysis');

    Route::delete('/hr/claims/{claim}', [ClaimController::class, 'destroy'])
        ->name('hr.claims.destroy');
        
      Route::post('/claims/{claim}/recompute', [ClaimController::class, 'requestRecompute'])
        ->name('claims.recompute');
});


// Route::middleware(['auth','hr.access'])
//   ->prefix('hr')
//   ->name('hr.')
//   ->group(function () {

//     Route::get('/dashboard', [PayslipController::class, 'index'])->name('dashboard');

//     Route::get('/payslips', [PayslipController::class, 'index'])->name('payslips.index');
//     Route::post('/payslips', [PayslipController::class, 'store'])->name('payslips.store');
//     Route::get('/payslips/{payslip}/download', [PayslipController::class, 'download'])->name('payslips.download');
//     Route::delete('/payslips/{payslip}', [PayslipController::class, 'destroy'])->name('payslips.destroy');

// });

Route::middleware(['auth'])->group(function () {

  Route::post('/hr/claims', [HRClaimController::class, 'store'])->name('hr.claims.store');

  

  // ✅ ADD THIS HERE (REALTIME FETCH)
    Route::get('/tickets/user', function () {
        return \App\Models\Ticket::where('user_id', Auth::id())
            ->latest()
            ->get();
    });

    
  Route::get('/user/coffee-registration', [UserCoffeeReg::class, 'create'])
        ->name('user.coffee-registration.create');

    Route::post('/user/coffee-registration', [UserCoffeeReg::class, 'store'])
        ->name('user.coffee-registration.store');

Route::post('/support/chat/upload', [SupportChatController::class, 'upload']);
Route::get('/support/chat',  [SupportChatController::class, 'fetch']);
  Route::post('/support/chat', [SupportChatController::class, 'send']);
  Route::delete('/support/chat', [SupportChatController::class, 'destroy']);

  Route::get('/support/unread-count', [SupportChatController::class, 'unreadCount']);
  

  Route::post('/support/presence/ping', [SupportPresenceController::class, 'ping']);
  Route::get('/support/presence/status', [SupportPresenceController::class, 'status']); 


Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
    ->name('tickets.updateStatus');


    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('tickets.dashboard');

        Route::get('/my-tickets', [TicketController::class, 'myTickets'])
    ->name('tickets.myTickets');

    Route::get('/announcements', [AnnouncementController::class, 'index'])
    ->name('tickets.announcements');

    

    Route::get('/tickets/create', [TicketController::class, 'create'])
        ->name('tickets.create');

    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('tickets.store');

        Route::post('/tickets/{id}/decline', [TicketController::class, 'decline']);

        Route::post('/tickets/{id}/approve', [TicketController::class, 'approve']);

});


Route::view('/', 'welcome')->name('home');
Route::view('/maintenance', 'maintenance')->name('maintenance');

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



Route::middleware(['auth', 'role:supplies'])->group(function () {
    Route::get('/supplies/dashboard', [SuppliesDashboardController::class, 'index'])
        ->name('supplies.supplies-dashboard');
});

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


Route::middleware(['auth'])->group(function () {
    Route::post('/attendance/log', [AttendanceController::class, 'log'])
        ->name('attendance.log');
});

Route::post('/exam/save-progress', [ExamController::class, 'saveProgress'])
    ->name('exam.saveProgress');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'redirect.dashboard.role', 'noback'])
    ->name('dashboard');

     Route::get(
  '/=jf8IGL03-kaodoj7UJjfnUJnkla8afeef8909JIKkfa=aefeaj90-83registrationikjfe9fasej=aojf8IGL03-kaodoj7UJjfnUJnkla8afeef8909JIKkfa=aefeaj90-83registrationikjfe9fasej',
  [UserCoffeeReg::class, 'create']
)->name('registration');

    
    Route::view(
        '/user-dashboard/uploading-requirements',
        'user-dashboard.uploading-requirements.uploading-requirements'
    )->name('uploading.requirements');
    
    Route::get('/I%2jdawh=adwIpkadLHiadw0476jhJI%2jdawh=adwIpkadLHiadw0476jhJI%2jdawh=adwIpkadLHiadw0476jhJ/{exam}', [ExamController::class, 'start'])
    ->name('exam.start');

    // Route::view(
    //     '/dwajn0938UIHi&*65wauhunotificationawduhygy6wedag=dwajn0938UIHi&*65wauhunotificationawduhygy6wedagdwajn0938UIHi&*65wauhunotificationawduhygy6wedag',
    //     'user-dashboard.notification.notification'
    // )->name('notification');


     Route::get('/notification', [NotificationController::class, 'index'])
        ->name('notification');


    Route::view(
        '/Pjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90daiuPjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90daiuPjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90daiu',
        'user-dashboard.attendance.attendance'
    )->name('attendance');

    Route::view(
        '/adw6daid7ad97w8ydawd3acr3rarvavr53a3adw6daid7ad97w8ydawd3acr3rarvavr53a3adw6daid7ad97w8ydawd3acr3rarvavr53a3',
        'user-dashboard.exam.proceed'
    )->name('proceed');

    Route::view(
        '/hauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJdhauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJdhauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJd',
        'user-dashboard.exam.video'
    )->name('video');

    Route::view(
        '/adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=e',
        'user-dashboard.exam.exam-done'
    )->name('exam-done');
});

Route::view('/franchise-application-process', 'franchise-application-process.franchise-application-process')
    ->name('franchise.process');

    Route::view('/franchise-patatas-process', 'franchise-application-process.franchise-patatas-process')
    ->name('patatas.process');

Route::get('/franchise/application', fn() =>
    view('franchise-application-process.franchise-application-process')
)->name('franchise.form');

Route::post('/franchise/submit', [FranchiseController::class, 'store'])
    ->name('franchise.submit');


Route::get('/ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse=ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse=ihu$HIHdw08dahi=opOjdN@7UUHOOIAWDIjsfse', [ExamController::class, 'select'])
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

Route::get(
    '/admin/exam-results/{id}/export-doc',
    [AdminExamController::class, 'exportDoc']
)->name('admin.exam-results.export-doc');

Route::middleware(['auth', 'admin.desktop'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


    Route::post('/tickets/{id}/transfer', [TicketController::class, 'transfer']);

    Route::get('/tickets/status-list', function () {
    return \App\Models\Ticket::select('id','status','approval_requested')->get();
});

    // HEADOFFICE PORTALS
Route::prefix('headoffice-portals')->name('portals.')->group(function () {

    // HR
    Route::view('/hr', 'admin.headoffice-portals.hr.dashboard')->name('hr');

    Route::get('/hr/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'hr')
        ->name('hr.tickets');

    // HR PAYSLIP
    Route::get('/hr/payslip', [PayslipController::class,'index'])
        ->name('hr.payslip');

    Route::post('/hr/payslip/upload', [PayslipController::class,'store'])
        ->name('hr.payslip.upload');

    Route::get('/hr/payslip/{payslip}/download', [PayslipController::class,'download'])
        ->name('hr.payslip.download');

    Route::delete('/hr/payslip/{payslip}', [PayslipController::class,'destroy'])
        ->name('hr.payslip.delete');
        

        // HR REGISTRATION
    Route::get('/hr/registration', [AdminCoffeeReg::class, 'index'])
        ->name('hr.registration');

        

    // IT
    Route::view('/it', 'admin.headoffice-portals.it.dashboard')->name('it');
    Route::get('/it/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'it')
        ->name('it.tickets');
    
        Route::post('/tickets/{ticket}/request-approval', 
    [TicketController::class, 'requestApproval'])
    ->name('admin.tickets.requestApproval');

    // OM
    Route::view('/om', 'admin.headoffice-portals.om.dashboard')->name('om');
    Route::get('/om/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'om')
        ->name('om.tickets');

    // OD
    Route::view('/od', 'admin.headoffice-portals.od.dashboard')->name('od');
    Route::get('/od/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'od')
        ->name('od.tickets');

    // SMM
    Route::view('/smm', 'admin.headoffice-portals.smm.dashboard')->name('smm');
    Route::get('/smm/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'smm')
        ->name('smm.tickets');

    Route::view('/admin-secretary', 'admin.headoffice-portals.admin-secretary.dashboard')->name('admin-secretary');
    Route::get('/admin-secretary/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'admin-secretary')
        ->name('admin-secretary.tickets');


});

    Route::patch('/tickets/{ticket}/view', [AdminTicketController::class, 'markViewed'])
    ->name('tickets.viewed');
    
    Route::get('/inbox', [ClaimInboxController::class, 'index'])
            ->name('inbox');

        Route::get('/claims/{claim}', [ClaimInboxController::class, 'show'])
            ->name('claims.show');

        Route::get('/admin-universal-portal/admin-portal', function () {
            return redirect()->route('admin.inbox');
        })->name('admin-portal');

     Route::get('/users-account-email', [UserEmailController::class, 'create'])
        ->name('users.email');

    Route::post('/users-account-email', [UserEmailController::class, 'send'])
        ->name('users.email.send');
        
    Route::post('/coffee-registrations/{reg}/documents', [AdminCoffeeReg::class, 'uploadDocuments'])
    ->name('coffee-registrations.documents');

        Route::get('/coffee-registrations', [AdminCoffeeReg::class, 'index'])
        ->middleware('hr.access')
            ->name('coffee-registrations.index');

        Route::patch('/coffee-registrations/{reg}', [AdminCoffeeReg::class, 'update'])
            ->name('coffee-registrations.update');

        
Route::delete('/coffee-registrations/{registration}', [AdminCoffeeReg::class, 'destroy'])
    ->name('coffee-registrations.destroy');


    Route::get('/user-registration', [AdminCoffeeReg::class, 'index'])
    ->name('registration'); 



     Route::get('/tickets', [AdminTicketController::class, 'index'])
            ->name('tickets.index');

        // Route::patch('/tickets/{ticket}', [AdminTicketController::class, 'update'])
        //     ->name('tickets.update');

        Route::delete('/tickets/{ticket}', [AdminTicketController::class, 'destroy'])
            ->name('tickets.destroy');
    
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

Route::get('/exam-results/{id}', [AdminExamResultController::class, 'show'])
        ->name('exam-results.view');

Route::get('/exam-results', [AdminExamResultController::class, 'results'])
            ->name('exam-results');

Route::delete('/exam-results/{id}', [AdminExamResultController::class, 'destroy'])
            ->name('exam-results.delete');

Route::get('/users-account', [UserManagementController::class, 'index'])
            ->name('users-account');

Route::delete('/users-account/{id}', [UserManagementController::class, 'destroy'])
            ->name('users-account.destroy');

Route::get('/users/register', [AdminUserController::class, 'create'])
            ->name('users.register');

Route::post('/users/register', [AdminUserController::class, 'store'])
            ->name('users.store');

Route::view('/', 'admin.admin')->name('dashboard');

Route::view('/application', 'admin.application')->name('application');



// ================= FOLDER SYSTEM =================

// DELETE FOLDER
Route::delete('/folder/{folder}', [RequirementController::class, 'deleteFolder'])
    ->name('folder.delete');

// MAIN PAGE (list of folders)
Route::get('/requirements', [RequirementController::class, 'index'])
    ->name('requirements');

// CREATE FOLDER
Route::post('/folder', [RequirementController::class, 'store'])
    ->name('folder.create');

// VIEW FOLDER (click folder)
Route::get('/folder/{folder}', [RequirementController::class, 'viewFolder'])
    ->name('folder.view');

// UPLOAD FILE INSIDE FOLDER
Route::post('/folder/{folder}/upload', [RequirementController::class, 'uploadToFolder'])
    ->name('folder.upload');

// DELETE FILE
Route::delete('/requirements/{id}', 
    [RequirementController::class, 'destroy']
)->name('requirements.delete');

Route::get('/uploading-exams', [AdminExamController::class, 'index'])
            ->name('uploading-exams');

Route::post('/exams/store', [AdminExamController::class, 'store'])
            ->name('exams.store');

Route::delete('/exams/delete/{id}', [AdminExamController::class, 'delete'])
            ->name('exams.delete');

Route::get('/applications', [FranchiseAdminController::class, 'index'])
            ->name('applications');

Route::get('/applications/{id}/pdf', [FranchiseAdminController::class, 'downloadPdf'])
    ->name('applications.pdf');

// Route::get('/applications/{id}/print', [FranchiseAdminController::class, 'print'])
//     ->name('applications.print');

Route::get('/applications/{id}', [FranchiseAdminController::class, 'show'])
            ->name('applications.show');

            Route::get('/applications/{id}/modal', [FranchiseAdminController::class, 'modal'])
  ->name('applications.modal');

Route::delete('/applications/{id}', [FranchiseAdminController::class, 'destroy'])
            ->name('applications.destroy');

Route::get('/users-account', [UserManagementController::class, 'index'])
            ->name('users-account');

Route::get('/contacts', function () {
    $contacts = \App\Models\Contact::latest()->get();
    return view('admin.contacts', compact('contacts'));
})->name('contacts');

Route::delete('/contacts/delete-all', function () {
    \App\Models\Contact::truncate();

    return redirect()
        ->route('admin.contacts')
        ->with('success', 'All contact messages have been deleted.');
})->name('contacts.deleteAll');

Route::delete('/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'destroy'])
    ->name('contacts.delete');
    });

//contact
Route::post('/contact/send', [ContactController::class, 'store'])
    ->name('contact.send');

Route::post('/user/logout', function (Request $request) {

    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');

})->name('custom.logout');

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
