<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\FranchiseAdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\CoffeeRegistrationController as AdminCoffeeReg;
use App\Http\Controllers\Admin\UserEmailController;
use App\Http\Controllers\Admin\ClaimInboxController;
use App\Http\Controllers\Admin\HeadOfficeTicketController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminSuppliesController;
use App\Http\Controllers\Admin\AdminTicketController;

use App\Http\Controllers\AdminExamController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminExamResultController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Hr\PayslipController;
use App\Http\Controllers\RegisterFranchiseeController;
use App\Http\Controllers\ContactController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/admin-profile', function () {
        return view('admin.admin-profile.edit', [
            'user' => Auth::user(),
        ]);
    })->name('admin.admin-profile.edit');
});

Route::get('/admin/exams/{id}/edit', [AdminExamController::class, 'edit'])
    ->name('admin.exams.edit');

Route::put('/admin/exams/{id}', [AdminExamController::class, 'update'])
    ->name('admin.exams.update');

Route::get('/admin/exam-results/{id}/export-doc', [AdminExamController::class, 'exportDoc'])
    ->name('admin.exam-results.export-doc');

Route::middleware(['auth', 'admin.desktop'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

Route::get('/coupon', [AdminCouponController::class, 'index'])
    ->name('coupon');

Route::get('/coupons', [AdminCouponController::class, 'index'])
    ->name('coupons.index');

Route::post('/coupons', [AdminCouponController::class, 'store'])
    ->name('coupons.store');

Route::post('/coupons/{id}/tag-sold', [AdminCouponController::class, 'tagSold'])
    ->name('coupons.tagSold');

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

Route::get('/od/register-franchise', [RegisterFranchiseeController::class, 'index'])
    ->name('od.register-franchise');

Route::post('/od/register-franchise', [RegisterFranchiseeController::class, 'store'])
    ->name('od.register-franchise.store');

Route::get('/od/register-franchise/{reservation}/print', [RegisterFranchiseeController::class, 'print'])
    ->name('od.register-franchise.print');

Route::get('/od/register-franchise/{reservation}/pdf', [RegisterFranchiseeController::class, 'pdf'])
    ->name('od.register-franchise.pdf');

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
    ->name('dashboard');

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

Route::get('/application', [FranchiseAdminController::class, 'index'])
    ->name('application');

// MAIN PAGE / ROOT FOLDERS
Route::get('/requirements', [RequirementController::class, 'index'])
    ->name('requirements');

// CREATE FOLDER SA ROOT
Route::post('/folder', [RequirementController::class, 'store'])
    ->name('folder.create');

// CREATE SUBFOLDER SA CURRENT FOLDER
Route::post('/folder/{folder}/create', [RequirementController::class, 'storeInsideFolder'])
    ->where('folder', '.*')
    ->name('folder.create.inside');

// VIEW ANY FOLDER / SUBFOLDER
Route::get('/folder/{folder}', [RequirementController::class, 'viewFolder'])
    ->where('folder', '.*')
    ->name('folder.view');

// UPLOAD FILE INSIDE ANY FOLDER / SUBFOLDER
Route::post('/folder/{folder}/upload', [RequirementController::class, 'uploadToFolder'])
    ->where('folder', '.*')
    ->name('folder.upload');

// DELETE ANY FOLDER / SUBFOLDER
Route::delete('/folder/{folder}', [RequirementController::class, 'deleteFolder'])
    ->where('folder', '.*')
    ->name('folder.delete');

// DELETE FILE
Route::delete('/requirements/{id}', [RequirementController::class, 'destroy'])
    ->name('requirements.delete');


Route::get('/uploading-exams', [AdminExamController::class, 'index'])
            ->name('uploading-exams');

Route::post('/exams/store', [AdminExamController::class, 'store'])
            ->name('exams.store');

Route::delete('/exams/delete/{id}', [AdminExamController::class, 'delete'])
            ->name('exams.delete');

Route::get('/applications', [FranchiseAdminController::class, 'index'])
            ->name('applications');

Route::post('/application/{id}/accept', [FranchiseAdminController::class, 'accept'])
    ->name('application.accept');

Route::get('/applications/{id}/pdf', [FranchiseAdminController::class, 'downloadPdf'])
    ->name('applications.pdf');

// Route::get('/applications/{id}/print', [FranchiseAdminController::class, 'print'])
//     ->name('applications.print');
Route::post('/application/{id}/reschedule',
[FranchiseAdminController::class,'reschedule'])
->name('application.reschedule');

Route::get('/applications/{id}', [FranchiseAdminController::class, 'show'])
            ->name('applications.show');

Route::get('/applications/{id}/modal', [FranchiseAdminController::class, 'modal'])
  ->name('applications.modal');

Route::delete('/applications/{id}', [FranchiseAdminController::class, 'destroy'])
            ->name('applications.destroy');

Route::post('/application/{id}/schedule', [FranchiseAdminController::class, 'schedule'])
->name('application.schedule');

Route::post('/application/{id}/start-discovery', [FranchiseAdminController::class, 'startDiscovery'])
->name('application.startDiscovery');

Route::post('/application/{id}/done-discovery', [FranchiseAdminController::class, 'doneDiscovery'])
->name('application.doneDiscovery');

Route::post('/application/{id}/close-deal', [FranchiseAdminController::class, 'closeDeal'])
->name('application.closeDeal');

Route::post('/application/{id}/decline', [FranchiseAdminController::class, 'decline'])
->name('application.decline');

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