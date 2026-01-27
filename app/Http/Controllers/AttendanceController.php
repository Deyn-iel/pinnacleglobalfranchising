<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\AttendanceSetting;


class AttendanceController extends Controller
{
    public function log(Request $request)
    {
        // ✅ 1️⃣ VALIDATION
    $request->validate([
        'type'     => 'required|in:morning_in,morning_out,afternoon_in,afternoon_out',
        'selfie'   => 'required|image|max:5120',
        'lat'      => 'required|numeric',
        'lng'      => 'required|numeric',
        'accuracy' => 'nullable|numeric',
    ]);

    // ✅ 2️⃣ EXTRA SAFETY (ANTI-TAMPER)
    if (!in_array($request->type, [
        'morning_in',
        'morning_out',
        'afternoon_in',
        'afternoon_out'
    ])) {
        return response()->json([
            'status'  => 'error',
            'code'    => 'INVALID_TYPE',
            'message' => 'Invalid attendance type'
        ], 400);
    }

    // ✅ 3️⃣ GET LOCATION SETTINGS
    $setting = AttendanceSetting::first();

    if (!$setting) {
        return response()->json([
            'status'  => 'error',
            'code'    => 'NO_LOCATION_CONFIG',
            'message' => 'Attendance location is not configured'
        ], 500);
    }

    $allowedLat = $setting->lat;
    $allowedLng = $setting->lng;
    $radius     = $setting->radius;

    // ✅ 4️⃣ GPS DISTANCE CHECK
    $distance = $this->distance(
        $request->lat,
        $request->lng,
        $allowedLat,
        $allowedLng
    );


    // GPS DISTANCE CHECK
if ($distance > $radius) {
    return response()->json([
        'status'  => 'error',
        'code'    => 'OUTSIDE_LOCATION',
        'message' => 'You are outside the allowed location'
    ], 403);
}

// GPS ACCURACY (RELAXED)
if ($request->accuracy && $request->accuracy > ($radius * 1.5)) {
    return response()->json([
        'status'  => 'error',
        'code'    => 'WEAK_GPS',
        'message' => 'GPS signal is too weak, move to open area'
    ], 403);
}





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
        ->whereBetween('created_at', [
            Carbon::today('Asia/Manila')->startOfDay(),
            Carbon::today('Asia/Manila')->endOfDay()
        ])
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

            $attendance->lat = $request->lat;
            $attendance->lng = $request->lng;
            $attendance->distance = round($distance);

        // ✅ SAVE TIME + SELFIE (PH TIME)
        $attendance->{$request->type} = $now;
        $attendance->{$request->type . '_selfie'} = $path;
        $attendance->save();

        return response()->json([
            'message' => strtoupper(str_replace('_', ' ', $request->type)) . ' saved successfully ✓'
        ]);
    }

    private function distance($lat1, $lng1, $lat2, $lng2)
{
    $earth = 6371000;
    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLng/2) * sin($dLng/2);

    return $earth * (2 * atan2(sqrt($a), sqrt(1 - $a)));
}

}
