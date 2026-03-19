<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return in_array($role, ['admin-secretary','hr','it','support','staff', 'om', 'od','smm']);
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

        $messages = SupportMessage::query()
            ->where('target_user_id', $targetUserId)
            ->when($afterId > 0, fn($qq) => $qq->where('id', '>', $afterId))
            ->with('user:id,name,usertype')
            ->orderBy('id')
            ->limit(200)
            ->get()
            ->map(function ($m) {
                return [
                    'id'   => $m->id,
                    'text' => $m->message,
                    'name' => $m->user->name ?? 'Unknown',
                    'role' => $m->user->usertype ?? 'user',
                    'time' => optional($m->created_at)->format('M d, Y h:i A') ?? '',
                    'mine' => (int) $m->user_id === (int) Auth::id(),
                ];
            });

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
    'target_user_id' => [$this->isStaff() ? 'required' : 'nullable', 'integer']
]);
        // $request->validate([
        //     'message' => ['required','string','max:2000'],
        //     'target_user_id' => [$this->isStaff() ? 'required' : 'nullable','integer'],
        // ]);

        $targetUserId = $this->isStaff()
            ? (int) $request->target_user_id
            : (int) Auth::id();

        if ($targetUserId <= 0) {
            return response()->json(['ok' => false, 'error' => 'Invalid target user'], 422);
        }

        $msg = SupportMessage::create([
            'user_id'        => (int) Auth::id(),
            'target_user_id' => $targetUserId,
            'message'        => $request->message,
        ]);

        return response()->json(['ok' => true, 'id' => $msg->id]);
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
    $deleted = SupportMessage::where('target_user_id', $target)->delete();

    return response()->json(['ok' => true, 'deleted' => $deleted]);
}
}
