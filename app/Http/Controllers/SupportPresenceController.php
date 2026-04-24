<?php

// app/Http/Controllers/SupportPresenceController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class SupportPresenceController extends Controller
{
  public function ping(Request $request)
{
    $userId = Auth::id();

    Cache::put('user-online-' . $userId, true, now()->addSeconds(15));

    return response()->json(['ok' => true]);
}

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

    $users = collect($ids)->map(function ($id) {
        return [
            'id' => $id,
            'online' => cache()->has('user-online-' . $id),
        ];
    });

    return response()->json(['users' => $users]);
}
}
