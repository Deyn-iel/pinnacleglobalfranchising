<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();

    // ✅ get unread count first
    $unreadCount = UserNotification::where('user_id', $user->id)
        ->whereNull('read_at')
        ->count();

    $items = UserNotification::where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    // ✅ mark all as read when opening page
    UserNotification::where('user_id', $user->id)
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

    return view('user-dashboard.notification.notification', compact('items', 'unreadCount'));
}
}
