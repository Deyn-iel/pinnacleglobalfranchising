<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $from;
    protected $to;
    protected $morningRequiredIn;
    protected $afternoonRequiredOut;
    protected $penalty;

    public function __construct(
        $from,
        $to,
        $morningRequiredIn,
        $afternoonRequiredOut,
        $penalty
    ) {
        $this->from = $from;
        $this->to   = $to;
        $this->morningRequiredIn    = Carbon::parse($morningRequiredIn);
        $this->afternoonRequiredOut = Carbon::parse($afternoonRequiredOut);
        $this->penalty              = $penalty;
    }

    public function collection(): Collection
    {
        return Attendance::with('user')
            ->whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)
            ->orderBy('created_at')
            ->get();
    }

    public function headings(): array
{
    return [
        'Date',
        'Name',
        'Morning In',
        'Morning Out',
        'Afternoon In',
        'Afternoon Out',
        'Late (mins)',
        'Salary Deduction (₱)',
    ];
}


    public function map($r): array
{
    // LATE MINUTES ONLY
    $lateMinutes = 0;

    if ($r->morning_in) {
        $actual = Carbon::parse($r->morning_in->format('H:i'));
        if ($actual->gt($this->morningRequiredIn)) {
            $lateMinutes += $actual->diffInMinutes($this->morningRequiredIn);
        }
    }

    if ($r->afternoon_out) {
        $actual = Carbon::parse($r->afternoon_out->format('H:i'));
        if ($actual->lt($this->afternoonRequiredOut)) {
            $lateMinutes += $this->afternoonRequiredOut->diffInMinutes($actual);
        }
    }

    $deduction = $lateMinutes * $this->penalty;

    return [
        $r->created_at->format('Y-m-d'),
        $r->user->name,
        optional($r->morning_in)->format('H:i'),
        optional($r->morning_out)->format('H:i'),
        optional($r->afternoon_in)->format('H:i'),
        optional($r->afternoon_out)->format('H:i'),
        $lateMinutes,
        $deduction,
    ];
}

}
