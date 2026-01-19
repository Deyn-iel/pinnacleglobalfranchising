<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function log(Request $request)
    {
        // ✅ VALIDATION
        $request->validate([
            'type'   => 'required|in:morning_in,morning_out,afternoon_in,afternoon_out',
            'selfie' => 'required|image|max:5120',
        ]);

        // ✅ AUTH CHECK
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // ✅ PH TIME (ITO ANG FIX)
        $now   = Carbon::now('Asia/Manila');
        $today = $now->toDateString();

        // ✅ ONE ATTENDANCE PER USER PER DAY (PH DATE)
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->first();

        if (!$attendance) {
            $attendance = Attendance::create([
                'user_id' => $user->id,
            ]);
        }

        // ❌ PREVENT DOUBLE LOG (SAME DAY ONLY)
        if ($attendance->{$request->type}) {
            return response()->json([
                'message' => strtoupper(str_replace('_', ' ', $request->type)) . ' already recorded !'
            ], 409);
        }

        // ✅ SAVE SELFIE
        $path = $request->file('selfie')
            ->store('attendance-selfies', 'public');

        // ✅ SAVE TIME + SELFIE (PH TIME)
        $attendance->{$request->type} = $now;
        $attendance->{$request->type . '_selfie'} = $path;
        $attendance->save();

        return response()->json([
            'message' => strtoupper(str_replace('_', ' ', $request->type)) . ' saved successfully ✓'
        ]);
    }
}
