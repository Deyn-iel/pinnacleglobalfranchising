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

        return in_array($role, ['admin','hr','it','support','staff']);
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
            'message' => ['required','string','max:2000'],
            'target_user_id' => [$this->isStaff() ? 'required' : 'nullable','integer'],
        ]);

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
    $request->validate([
        'target_user_id' => ['required','integer']
    ]);

    $me = (int) Auth::id();
    $target = (int) $request->target_user_id;

    // Delete all messages between the two users
    SupportMessage::where(function($q) use ($me, $target){
        $q->where('user_id', $me)->where('target_user_id', $target);
    })->orWhere(function($q) use ($me, $target){
        $q->where('user_id', $target)->where('target_user_id', $me);
    })->delete();

    return response()->json(['ok' => true]);
}
}
