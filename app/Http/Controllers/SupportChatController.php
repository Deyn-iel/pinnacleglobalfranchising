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

    // add mo yung exact role label mo kung iba
    $isStaff = in_array($role, ['admin','hr','it','support','staff']);

    // OPTIONAL: kung may is_admin column ka
    // $isStaff = $isStaff || ((int)($user->is_admin ?? 0) === 1);

    return $isStaff;
}


  // GET: fetch messages
  public function fetch(Request $request)
{
    $afterId = (int) $request->query('after_id', 0);

    // sino yung ka-chat (target account)
    $targetUserId = (int) $request->query('target_user_id', 0);

    // kung normal user, forced sa sarili nya lang
    if (!$this->isStaff()) {
        $targetUserId = Auth::id();
    }

    if ($targetUserId <= 0) {
        return response()->json(['messages' => [], 'last_id' => $afterId]);
    }

    $q = SupportMessage::query()
        ->where('target_user_id', $targetUserId)
        ->when($afterId > 0, fn($qq) => $qq->where('id', '>', $afterId))
        ->with('user:id,name,usertype')
        ->orderBy('id');

    $messages = $q->get()->map(function ($m) {
        return [
            'id'   => $m->id,
            'text' => $m->message,
            'name' => $m->user->name ?? 'Unknown',
            'role' => $m->user->usertype ?? 'user',
            'time' => optional($m->created_at)->format('M d, Y h:i A') ?? '',
            'mine' => (int)$m->user_id === (int)Auth::id(),
        ];
    });

    return response()->json([
        'messages' => $messages,
        'last_id'  => $messages->last()['id'] ?? $afterId,
    ]);
}



  // POST: send message
  public function send(Request $request)
{
    $request->validate([
      'message' => ['required','string','max:2000'],
      'target_user_id' => ['required','integer'],
    ]);

    // normal user: bawal mag-impersonate, sarili lang target
    $targetUserId = $this->isStaff()
        ? (int) $request->target_user_id
        : (int) Auth::id();

    $msg = SupportMessage::create([
      'user_id' => Auth::id(),          // sender
      'target_user_id' => $targetUserId, // conversation owner
      'message' => $request->message,
    ]);

    return response()->json(['ok' => true, 'id' => $msg->id]);
}


}
