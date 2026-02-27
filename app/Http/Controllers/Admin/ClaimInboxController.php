<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimInboxController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $status = trim((string) $request->get('status', ''));
        $benefit = trim((string) $request->get('benefit', ''));

        // Base query (for list + KPIs)
        $base = Claim::query()
            ->with(['hrUser']) // to show who submitted
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('claim_code', 'like', "%{$q}%")
                        ->orWhere('employee_given', 'like', "%{$q}%")
                        ->orWhere('employee_middle', 'like', "%{$q}%")
                        ->orWhere('employee_surname', 'like', "%{$q}%")
                        ->orWhere('benefit', 'like', "%{$q}%")
                        ->orWhere('status', 'like', "%{$q}%");
                });
            })
            ->when($status, fn($query) => $query->where('status', $status))
            ->when($benefit, fn($query) => $query->where('benefit', $benefit))
            ->latest('created_at');

        // Paginated list
        $claims = (clone $base)->paginate(20)->withQueryString();

        // computed fields used by blade
        $claims->getCollection()->transform(function ($c) {
            $c->claim_id = $c->claim_code;
            $c->employee_name = trim($c->employee_given.' '.$c->employee_middle.' '.$c->employee_surname);
            $c->date_submitted = optional($c->created_at)->format('Y-m-d') ?? '—';
            $c->aging_days = $c->created_at ? $c->created_at->diffInDays(now()) : 0;

            // "company" not in schema — show HR submitter instead (so may laman UI)
            $c->company = optional($c->hrUser)->name ? ('HR: '.optional($c->hrUser)->name) : 'HR: —';

            return $c;
        });

        // KPI counts (based on filtered base, not just current page)
        $all = (clone $base)->get();
        $kpi = [
            'open'      => $all->count(), // you can change to "non-closed only" if you add closed statuses
            'submitted' => $all->where('status', 'Submitted')->count(),
            'reviewing' => $all->where('status', 'Reviewing')->count(),
            'checking'  => $all->where('status', 'For Checking')->count(),
            'overdue'   => $all->filter(fn($c) => $c->created_at && $c->created_at->diffInDays(now()) > 14)->count(),
        ];

        return view('admin.admin-universal-portal.admin-portal', compact('claims','kpi'));
    }

    /**
     * Drawer JSON details
     * GET /admin/claims/{claim}
     */
    public function show(Claim $claim)
    {
        $claim->load(['hrUser', 'attachments', 'receipts']);

        $dateSubmitted = optional($claim->created_at)->format('Y-m-d') ?? '—';
        $agingDays = $claim->created_at ? $claim->created_at->diffInDays(now()) : 0;

        // attachments stored as labels (keys) e.g. policy_data_page, claim_form, etc.
        $present = $claim->attachments->pluck('label')->map(fn($x) => (string)$x)->toArray();
        $has = fn($key) => in_array($key, $present, true);

        // docs checklist (match your UI labels)
        $docs = [
            "Policy Data Page (mandatory)" => $has('policy_data_page'),
            "Claim Form (mandatory)" => $has('claim_form'),
            "PhilHealth Deduction Statement (mandatory)" => $has('philhealth_deduction'),
            "Attending Physician Statement (mandatory)" => $has('physician_statement'),
            "HR Endorsement" => $has('hr_endorsement'),
            "SOA (itemized)" => $has('soa_itemized'),
            "Official Receipts" => $claim->receipts->count() > 0, // receipts table
            "Medical Abstract" => $has('medical_abstract'),
            "Surgical Report (if applicable)" => $has('surgical_report'),
            "Doctor's Prescription" => $has('doctors_prescription'),
            "Police/Barangay/Employee Report" => $has('incident_report'),
            "Others" => $has('others_file'),
        ];

        // simple history (since no timeline table yet)
        $history = [];
        if ($claim->created_at) {
            $history[] = $claim->created_at->format('Y-m-d').' • Submitted by HR';
        }
        $history[] = now()->format('Y-m-d').' • Status: '.$claim->status;

        return response()->json([
    'id' => $claim->claim_code,
    'dateSubmitted' => $dateSubmitted,
    'agingDays' => $agingDays,

    'company' => optional($claim->hrUser)->name ? ('HR: '.optional($claim->hrUser)->name) : 'HR: —',

    'submittedBy' => optional($claim->hrUser)->name ?? '—',
    'submittedEmail' => optional($claim->hrUser)->email ?? '—',

    'employee' => trim($claim->employee_given.' '.$claim->employee_middle.' '.$claim->employee_surname),
    'benefit' => $claim->benefit,
    'status' => $claim->status,
    'version' => (int) ($claim->occurrence ?? 1),

    'docs' => $docs,
    'history' => $history,
]);
    }
}