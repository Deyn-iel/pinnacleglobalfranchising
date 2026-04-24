<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\AttendanceSetting;


class AdminAttendanceController extends Controller
{
    public function index(Request $request)
{
    $date = $request->query('date'); 

    $records = Attendance::with('user')
        ->when($date, function ($q) use ($date) {
            $q->whereDate('created_at', $date);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $setting = AttendanceSetting::first();

    $selfie = null;

    return view('admin.attendance', compact('records', 'date', 'setting', 'selfie'));
}
    public function destroy($id)
{
    $attendance = Attendance::findOrFail($id);

    // delete selfie file
    foreach ([
    $attendance->morning_in_selfie,
    $attendance->morning_out_selfie,
    $attendance->afternoon_in_selfie,
    $attendance->afternoon_out_selfie,
] as $selfie) {
    if ($selfie) {
        Storage::disk('public')->delete($selfie);
    }
}


    $attendance->delete();

    return redirect()
        ->route('admin.attendance')
        ->with('success', 'Attendance deleted successfully.');
}
public function exportRange(Request $request)
{
    $request->validate([
        'from'                   => 'required|date',
        'to'                     => 'required|date|after_or_equal:from',
        'morning_required_in'    => 'required',
        'afternoon_required_out' => 'required',
        'penalty'                => 'required|numeric|min:0',
    ]);

    return Excel::download(
        new AttendanceExport(
            $request->from,
            $request->to,
            $request->morning_required_in,
            $request->afternoon_required_out,
            $request->penalty
        ),
        "attendance_{$request->from}_to_{$request->to}.xlsx"
    );
}


public function update(Request $request, Attendance $attendance)
{
    $request->validate([
        'morning_in'     => 'nullable|date_format:H:i',
        'morning_out'    => 'nullable|date_format:H:i',
        'afternoon_in'   => 'nullable|date_format:H:i',
        'afternoon_out'  => 'nullable|date_format:H:i',
    ]);

    // Preserve original date, only replace time
    foreach ([
        'morning_in',
        'morning_out',
        'afternoon_in',
        'afternoon_out',
    ] as $field) {

        if ($request->$field) {
            $attendance->$field = Carbon::parse(
                $attendance->$field
                    ? $attendance->$field->format('Y-m-d') . ' ' . $request->$field
                    : $attendance->created_at->format('Y-m-d') . ' ' . $request->$field
            );
        }
    }

    $attendance->save();

    return back()->with('success', 'Attendance time updated successfully.');
}

public function editLocation()
{
    $setting = AttendanceSetting::first();
    return view('admin.attendance.location', compact('setting'));
}

public function updateLocation(Request $request)
{
    $request->validate([
        'lat'    => 'required|numeric',
        'lng'    => 'required|numeric',
        'radius' => 'required|integer|min:10'
    ]);

    AttendanceSetting::updateOrCreate(
    ['id' => AttendanceSetting::first()?->id],
    $request->only('lat', 'lng', 'radius')
);


    return back()->with('success', 'Attendance location updated');
}

}
