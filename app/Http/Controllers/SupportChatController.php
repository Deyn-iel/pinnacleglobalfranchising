<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SupportChatController extends Controller
{
    private function isStaff(): bool
    {
        $user = Auth::user();

        $rawRole = $user->role
            ?? $user->user_type
            ?? $user->usertype
            ?? $user->type
            ?? '';

        $role = strtolower(trim((string)$rawRole));

        return in_array($role, ['admin','admin-secretary','hr','it','support','staff', 'om', 'od','smm']);
    }

    // GET: fetch messages
    public function fetch(Request $request)
    {
        $afterId = (int) $request->query('after_id', 0);
        $targetUserId = (int) $request->query('target_user_id', 0);

        // normal user: sarili lang
        if (!$this->isStaff()) {
            $targetUserId = (int) Auth::id();
        }

        if ($targetUserId <= 0) {
            return response()->json(['messages' => [], 'last_id' => $afterId]);
        }

        $ticketId = (int) $request->query('ticket_id', 0);

$query = SupportMessage::query()
    ->where(function($q) use ($targetUserId) {
        $q->where('target_user_id', $targetUserId)
          ->orWhere('user_id', $targetUserId);
    });

// ✅ filter by ticket (IMPORTANT)
if ($ticketId > 0) {
    $query->where('ticket_id', $ticketId);
}

$messages = $query
    ->when($afterId > 0, fn($qq) => $qq->where('id', '>', $afterId))
    ->with('user:id,name,usertype')
    ->orderBy('id')
    ->limit(200)
    ->get()
    ->map(function ($m) {
        return [
            'id'   => $m->id,
            'text' => $m->message,
            'type' => $m->type ?? 'text',
            'name' => $m->user->name ?? 'Unknown',
            'role' => $m->user->usertype ?? 'user',
            'time' => optional($m->created_at)->format('M d, Y h:i A') ?? '',
            'mine' => (int) $m->user_id === (int) Auth::id(),
        ];
    });

// ✅ DITO MO ILALAGAY
if ($request->query('mark_as_read') == 1) {

    if ($this->isStaff()) {

        // ✅ ADMIN viewing USER messages
        SupportMessage::where('user_id', $targetUserId)
            ->where('target_user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

    } else {

        // ✅ USER viewing ADMIN messages
        SupportMessage::where('target_user_id', Auth::id()) // TO USER
            ->where('user_id', '!=', Auth::id()) // FROM ADMIN
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }
}

        $lastIdOut = $messages->last()['id'] ?? $afterId;

        return response()->json([
            'messages' => $messages,
            'last_id'  => $lastIdOut,
        ]);
    }

    // POST: send message
    public function send(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'department' => 'nullable|string'
    ]);

    $authUser = Auth::user();

    $department = null; // ✅ FIX #1 (IMPORTANT)

    if ($this->isStaff()) {

     $department = strtolower($authUser->usertype);

        // ✅ ADMIN → USER
        $targetUserId = (int) $request->input('target_user_id');

        if (!$targetUserId || $targetUserId === $authUser->id) {
            return response()->json([
                'error' => 'Invalid target user'
            ], 422);
        }

    } else {

        // ✅ USER → ADMIN
        $department = strtolower($request->input('department', 'it'));

        $admin = \App\Models\User::where('usertype', $department)->first();

        if (!$admin) {
            $admin = \App\Models\User::whereIn('usertype', [
                'admin','admin-secretary','support','staff'
            ])->first();
        }

        $targetUserId = $admin?->id;
    }

    // ✅ SAVE MESSAGE
    $msg = SupportMessage::create([
        'user_id'        => (int) $authUser->id,
        'target_user_id' => $targetUserId,
        'message'        => $request->message,
        'department'     => $department, // ✅ SAFE NA
        'is_read'        => false,
    ]);

    // ✅ PREVENT EMAIL SPAM
    $alreadyUnread = SupportMessage::where('target_user_id', $targetUserId)
        ->where('notified', true)
        ->where('id', '!=', $msg->id)
        ->exists();

    // 🔥 CHECK ONLINE USING CACHE (TAMA NA SYSTEM MO)
if ($this->isStaff()) {

    // admin → check user
    $isOnline = cache()->has('user-online-' . $targetUserId);

} else {

    // user → check ANY staff
    $staffIds = \App\Models\User::whereIn('usertype', [
        'admin','admin-secretary','hr','it','support','staff','om','od','smm'
    ])->pluck('id');

    $isOnline = false;

    foreach ($staffIds as $id) {
        if (cache()->has('user-online-' . $id)) {
            $isOnline = true;
            break;
        }
    }
}

// ✅ FINAL CONDITION
if (!$alreadyUnread && !$isOnline) {

        // ✅ SAME AS TICKET CONTROLLER
        $mainEmails = explode(',', env('SUPPORT_NOTIFY_EMAILS'));

        $departmentMap = [
            'it' => env('IT_SUPPORT_EMAIL'),
            'hr' => env('HR_SUPPORT_EMAIL'),
            'smm' => env('SMM_SUPPORT_EMAIL'),
            'finance' => env('FINANCE_SUPPORT_EMAIL'),
            'admin-secretary' => env('ADMIN_SUPPORT_EMAIL'),
            'od' => env('OPERATIONS_DIRECTOR_SUPPORT_EMAIL'),
            'om' => env('OPERATIONS_MANAGER_EMAIL'),
        ];

        $departmentEmail = $department ? ($departmentMap[$department] ?? null) : null;

        $emails = $mainEmails;

        if ($departmentEmail) {
            $emails[] = $departmentEmail;
        }

        try {

            if (!empty($emails)) {

                $url = url('/login');

                Mail::html("
                <div style='font-family: Arial, sans-serif; background:#f4f6f9; padding:30px;'>

    <!-- ✅ EMAIL PREVIEW FIX -->
    <div style='display:none; max-height:0; overflow:hidden; opacity:0;'>
        You have a new support message. Open your dashboard to view it.
    </div>

    <div style='
        max-width:500px;
        margin:auto;
        background:#ffffff;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 5px 20px rgba(0,0,0,0.08);
    '>

        <div style='
            background:#0d3553;
            padding:20px;
            color:#fff;
            text-align:center;
            font-size:18px;
            font-weight:bold;
        '>
            💬 New Support Message
        </div>

        <div style='padding:25px; color:#333;'>

            <p style='margin-bottom:10px; font-size:15px;'>
                Hello,
            </p>

            <p style='margin-bottom:15px; font-size:15px;'>
                You have received a new message.
            </p>

            <div style='text-align:center;'>
                <a href='{$url}' 
                   style='
                     display:inline-block;
                     padding:12px 25px;
                     background:#0d3553;
                     color:#fff;
                     text-decoration:none;
                     border-radius:8px;
                     font-size:14px;
                     font-weight:bold;
                   '>
                   Open Chat
                </a>
            </div>

        </div>

        <div style='
            text-align:center;
            font-size:12px;
            color:#888;
            padding:15px;
            border-top:1px solid #eee;
        '>
            This is an automated message from Pinnacle Support.
        </div>

    </div>
</div>
                ", function ($mail) use ($emails) {
                    $mail->to($emails)
                         ->subject("New Chat Message");
                });
            }

            // ✅ MARK AS NOTIFIED
            $msg->update(['notified' => true]);

        } catch (\Throwable $e) {
            Log::error('Chat email failed: ' . $e->getMessage());
        }
    }

    return response()->json([
        'ok' => true,
        'id' => $msg->id
    ]);
}

public function destroy(Request $request)
{
    // staff: pwedeng mag delete ng kahit sinong thread (by target_user_id)
    // normal user: sarili lang ang pwedeng i-delete
    $target = $this->isStaff()
        ? (int) $request->input('target_user_id', 0)
        : (int) Auth::id();

    if ($target <= 0) {
        return response()->json(['ok' => false, 'error' => 'Invalid target user'], 422);
    }

    // ✅ delete buong thread (lahat ng chats, kahit sino sender)
    $deleted = SupportMessage::where(function($q) use ($target){
    $q->where('target_user_id', $target)
      ->orWhere('user_id', $target);
})->delete();

    return response()->json(['ok' => true, 'deleted' => $deleted]);
}

public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:20240', // 20MB
    ]);

    $authUser = Auth::user();

if ($this->isStaff()) {

    $targetUserId = (int) $request->input('target_user_id');

if (!$targetUserId || $targetUserId === $authUser->id) {
    return response()->json([
        'error' => 'Invalid target user'
    ], 422);
}

} else {

    $department = strtolower($request->input('department'));

if (!$department) {
    return response()->json([
        'error' => 'Department is required'
    ], 422);
}

$admin = \App\Models\User::where('usertype', $department)->first();

if (!$admin) {
    $admin = \App\Models\User::whereIn('usertype', [
        'admin','support','staff'
    ])->first();
}

$targetUserId = $admin?->id;
}

    if (!$request->hasFile('file')) {
        return response()->json(['error' => 'No file'], 400);
    }

    $file = $request->file('file');

    // ✅ STORE FILE
    $path = $file->store('chat_files', 'public');

    // ✅ DETERMINE TYPE
    $mime = $file->getMimeType();

    $type = 'file';
    if (str_starts_with($mime, 'image/')) $type = 'image';
    elseif (str_starts_with($mime, 'video/')) $type = 'video';
    elseif ($mime === 'application/pdf') $type = 'pdf';

    // ✅ SAVE AS MESSAGE
    $msg = SupportMessage::create([
    'user_id'        => (int) $authUser->id,
    'target_user_id' => $targetUserId,
    'message'        => $path,
    'type'           => $type,

    // ✅ ADD THIS DIN
    'is_read'        => false,
]);

    return response()->json([
        'ok'   => true,
        'id'   => $msg->id,
        'path' => $path,
        'type' => $type
    ]);
}


public function unreadCount(Request $request)
{
    $user = Auth::user();

    $department = strtolower($request->query('department'));

    $isStaff = in_array(strtolower($user->usertype), [
        'admin','admin-secretary','hr','it','support','staff','om','od','smm'
    ]);

    if ($isStaff) {

        $targetUserId = (int) $request->query('user_id');

        if ($targetUserId > 0) {

            $count = SupportMessage::where('user_id', $targetUserId)
                ->where('is_read', false)
                ->where(function($q) use ($user, $department){
                    $q->where('target_user_id', $user->id);

                    if($department){
                        $q->orWhere('department', $department);
                    }
                })
                ->count();

        } else {
            $count = 0;
        }

    } else {

        $count = SupportMessage::where('target_user_id', $user->id)
            ->where('user_id', '!=', $user->id)
            ->where('is_read', false)
            ->count();
    }

    return response()->json(['count' => $count]);
}

}
