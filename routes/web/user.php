<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SupportChatController;
use App\Http\Controllers\SupportPresenceController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\User\CoffeeRegistrationController as UserCoffeeReg;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\CouponClaimController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\HR\ClaimController as HRClaimController;

Route::middleware(['auth'])->group(function () {
    Route::get('/company-files/{department}', [RequirementController::class, 'portalIndex'])
        ->name('portal.company-files');

    Route::get('/company-files/{department}/{folder}', [RequirementController::class, 'portalFolder'])
        ->where('folder', '.*')
        ->name('portal.company-files.folder');

    Route::post('/hr/claims', [HRClaimController::class, 'store'])
        ->name('hr.claims.store');

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
    Route::get('/support/chat', [SupportChatController::class, 'fetch']);
    Route::post('/support/chat', [SupportChatController::class, 'send']);
    Route::delete('/support/chat', [SupportChatController::class, 'destroy']);
    Route::get('/support/unread-count', [SupportChatController::class, 'unreadCount']);
    Route::post('/support/presence/ping', [SupportPresenceController::class, 'ping']);
    Route::get('/support/presence/status', [SupportPresenceController::class, 'status']);

    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
        ->name('tickets.updateStatus');

    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('tickets.dashboard');

    Route::get('/coupon', [CouponClaimController::class, 'index'])
        ->name('tickets.coupon');

    Route::post('/coupon/verify', [CouponClaimController::class, 'verify'])
        ->name('tickets.coupon.verify');

    Route::post('/coupon/claim', [CouponClaimController::class, 'claim'])
        ->name('tickets.coupon.claim');

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

    Route::post('/attendance/log', [AttendanceController::class, 'log'])
        ->name('attendance.log');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->middleware(['redirect.dashboard.role', 'noback'])
        ->name('dashboard');

    Route::get(
        '/=jf8IGL03-kaodoj7UJjfnUJnkla8afeef8909JIKkfa=aefeaj90-83registrationikjfe9fasej=aojf8IGL03-kaodoj7UJjfnUJnkla8afeef8909JIKkfa=aefeaj90-83registrationikjfe9fasej',
        [UserCoffeeReg::class, 'create']
    )->name('registration');

    Route::view('/user-dashboard/uploading-requirements', 'user-dashboard.uploading-requirements.uploading-requirements')
        ->name('uploading.requirements');

    Route::get('/I%2jdawh=adwIpkadLHiadw0476jhJI%2jdawh=adwIpkadLHiadw0476jhJI%2jdawh=adwIpkadLHiadw0476jhJ/{exam}', [ExamController::class, 'start'])
        ->name('exam.start');

    Route::get('/notification', [NotificationController::class, 'index'])
        ->name('notification');

    Route::view('/Pjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90daiuPjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90daiuPjaefiu=8yhbPFUaehu89fsaehui-jieafawdawd90daiu', 'user-dashboard.attendance.attendance')
        ->name('attendance');

    Route::view('/adw6daid7ad97w8ydawd3acr3rarvavr53a3adw6daid7ad97w8ydawd3acr3rarvavr53a3adw6daid7ad97w8ydawd3acr3rarvavr53a3', 'user-dashboard.exam.proceed')
        ->name('proceed');

    Route::view('/hauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJdhauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJdhauwdh9839j9ed9oIEJ8eh=videoefuj)jawd-iiadwjmo0PDJd', 'user-dashboard.exam.video')
        ->name('video');

    Route::view('/adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=adw6daid7ad97w8ydawd3acr3rarvavr5dawda1=e', 'user-dashboard.exam.exam-done')
        ->name('exam-done');
});