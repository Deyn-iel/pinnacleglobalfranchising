<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HrDashboardController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $status = trim((string) $request->get('status', ''));
        $benefit = trim((string) $request->get('benefit', ''));

        $claimsQuery = Claim::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('employee_given', 'like', "%{$q}%")
                       ->orWhere('employee_middle', 'like', "%{$q}%")
                       ->orWhere('employee_surname', 'like', "%{$q}%")
                       ->orWhere('claim_code', 'like', "%{$q}%")
                       ->orWhere('claim_type', 'like', "%{$q}%")
                       ->orWhere('benefit', 'like', "%{$q}%");
                });
            })
            ->when($status, fn($query) => $query->where('status', $status))
            ->when($benefit, fn($query) => $query->where('benefit', $benefit))
            ->latest('created_at');

        $claims = $claimsQuery->paginate(10)->withQueryString();

        // Add computed fields used by blade
        $claims->getCollection()->transform(function ($c) {
            $c->employee_name = trim($c->employee_given.' '.$c->employee_middle.' '.$c->employee_surname);
            $c->employment = $c->employment_status;
            $c->claim_id = $c->claim_code;
            $c->date_submitted = optional($c->created_at)->format('Y-m-d') ?? '—';
            $c->aging_days = $c->created_at
            ? (int) $c->created_at->startOfDay()->diffInDays(now()->startOfDay())
            : 0;
            return $c;
        });

        $all = (clone $claimsQuery)->get();
        $summary = [
            'total'    => $all->count(),
            'overdue' => $all->filter(fn($c) =>
                $c->created_at && $c->created_at->startOfDay()->diffInDays(now()->startOfDay()) > 14
            )->count(),
            'checking' => $all->where('status', 'For Checking')->count(),
            'ready'    => $all->whereIn('status', ['Approved','Ready to Download'])->count(),
        ];

        return view('universal-portal.portal', compact('claims', 'summary'));
    }
}