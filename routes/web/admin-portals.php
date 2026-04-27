<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HeadOfficeTicketController;
use App\Http\Controllers\Admin\CoffeeRegistrationController as AdminCoffeeReg;
use App\Http\Controllers\Hr\PayslipController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RegisterFranchiseeController;

Route::prefix('headoffice-portals')->name('portals.')->group(function () {
    Route::view('/hr', 'admin.headoffice-portals.hr.dashboard')->name('hr');

    Route::get('/hr/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'hr')
        ->name('hr.tickets');

    Route::get('/hr/payslip', [PayslipController::class, 'index'])
        ->name('hr.payslip');

    Route::post('/hr/payslip/upload', [PayslipController::class, 'store'])
        ->name('hr.payslip.upload');

    Route::get('/hr/payslip/{payslip}/download', [PayslipController::class, 'download'])
        ->name('hr.payslip.download');

    Route::delete('/hr/payslip/{payslip}', [PayslipController::class, 'destroy'])
        ->name('hr.payslip.delete');

    Route::get('/hr/registration', [AdminCoffeeReg::class, 'index'])
        ->name('hr.registration');

    Route::view('/it', 'admin.headoffice-portals.it.dashboard')->name('it');

    Route::get('/it/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'it')
        ->name('it.tickets');

    Route::post('/tickets/{ticket}/request-approval', [TicketController::class, 'requestApproval'])
        ->name('admin.tickets.requestApproval');

    Route::view('/om', 'admin.headoffice-portals.om.dashboard')->name('om');

    Route::get('/om/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'om')
        ->name('om.tickets');

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

    Route::view('/smm', 'admin.headoffice-portals.smm.dashboard')->name('smm');

    Route::get('/smm/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'smm')
        ->name('smm.tickets');

    Route::view('/admin-secretary', 'admin.headoffice-portals.admin-secretary.dashboard')
        ->name('admin-secretary');

    Route::get('/admin-secretary/tickets', [HeadOfficeTicketController::class, 'index'])
        ->defaults('department', 'admin-secretary')
        ->name('admin-secretary.tickets');
});