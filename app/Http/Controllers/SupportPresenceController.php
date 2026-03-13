<?php

// app/Http/Controllers/SupportPresenceController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportPresenceController extends Controller
{
  // user/admin: heartbeat update
  public function ping(Request $request)
  {
    $userId = $request->user()->id;

    DB::table('users')->where('id', $userId)->update([
      'last_seen_at' => now(),
    ]);

    return response()->json(['ok' => true]);
  }

  // admin/user: check status of target user(s)
  // ?user_ids=1,2,3 OR ?user_id=5
  public function status(Request $request)
  {
    $idsRaw = $request->query('user_ids');
    $single = $request->query('user_id');

    $ids = [];
    if ($idsRaw) {
      $ids = collect(explode(',', $idsRaw))
        ->map(fn($v) => (int) trim($v))
        ->filter(fn($v) => $v > 0)
        ->values()
        ->all();
    } elseif ($single) {
      $ids = [(int)$single];
    }

    if (empty($ids)) {
      return response()->json(['users' => []]);
    }

    $rows = DB::table('users')
      ->select('id', 'last_seen_at')
      ->whereIn('id', $ids)
      ->get();

    $onlineWindowSeconds = 20; 
    $now = now();

    $users = $rows->map(function($u) use ($now, $onlineWindowSeconds) {
      $last = $u->last_seen_at ? \Carbon\Carbon::parse($u->last_seen_at) : null;
      $isOnline = $last ? $last->diffInSeconds($now) <= $onlineWindowSeconds : false;

      return [
        'id' => (int)$u->id,
        'online' => $isOnline,
        'last_seen_at' => $u->last_seen_at,
      ];
    })->values();

    return response()->json(['users' => $users]);
  }
}
