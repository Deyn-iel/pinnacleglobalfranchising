<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ClaimController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'surname' => ['required', 'string', 'max:100'],
            'given'   => ['required', 'string', 'max:100'],
            'middle'  => ['nullable', 'string', 'max:100'],
            'dob'     => ['required', 'date'],
            'civil'   => ['required', Rule::in(['Single', 'Married'])],
            'empType'    => ['required', 'string', 'max:120'],
            'claimType'  => ['required', Rule::in(['Personal Claim', "Dependent's Claim"])],
            'benefit'    => ['required', Rule::in(['Basic Medical', 'Major Medical', 'Dread Disease', 'Accident Benefit'])],
            'claimOccurrence' => ['nullable','integer','min:1','max:10'],

            // dependent
            'depName' => ['nullable', 'string', 'max:200'],
            'depRel'  => ['nullable', Rule::in(['Parent', 'Spouse', 'Children'])],
            'depDob'  => ['nullable', 'date'],
            'roomDate'      => ['nullable', 'date'],
            'timeIn'        => ['nullable', 'date_format:H:i'],
            'timeOut'       => ['nullable', 'date_format:H:i'],
            'amtPerReceipt' => ['nullable', 'numeric', 'min:0'],
            'receipts' => ['nullable', 'array'],
            'receipts.*.category' => ['required_with:receipts', 'string', 'max:60'],
            'receipts.*.description' => ['required_with:receipts', 'string', 'max:200'],
            'receipts.*.amount' => ['required_with:receipts', 'numeric', 'min:0.01'],
            'receipt_lines_json' => ['required', 'string'],
            'attachments' => ['required','array'],
            'attachments.policy_data_page'     => ['required','file','max:20480'], 
            'attachments.claim_form'           => ['required','file','max:20480'],
            'attachments.philhealth_deduction' => ['required','file','max:20480'],
            'attachments.physician_statement'  => ['required','file','max:20480'],
            
            // OPTIONAL uploads (pwede wala)
            'attachments.hr_endorsement'       => ['nullable','file','max:20480'],
            'attachments.soa_itemized'         => ['nullable','file','max:20480'],
            'attachments.medical_abstract'     => ['nullable','file','max:20480'],
            'attachments.surgical_report'      => ['nullable','file','max:20480'],
            'attachments.doctors_prescription' => ['nullable','file','max:20480'],
            'attachments.incident_report'      => ['nullable','file','max:20480'],
            'attachments.others_file'          => ['nullable','file','max:20480'],
        ]);

if ($request->filled('receipt_lines_json')) {
    $decoded = json_decode($request->input('receipt_lines_json','[]'), true);
if (!is_array($decoded) || count($decoded) === 0) {
    return back()->withErrors([
        'receipt_lines_json' => 'Please add at least 1 receipt line.'
    ])->withInput();
}

    foreach ($decoded as $i => $line) {
        $cat  = $line['cat']  ?? null;
        $desc = $line['desc'] ?? null;
        $amt  = $line['amt']  ?? null;

        if (!is_string($cat) || trim($cat) === '') {
            return back()->withErrors([
                'receipt_lines_json' => "Receipt line #".($i+1).": category is required."
            ])->withInput();
        }

        if (!is_string($desc) || trim($desc) === '') {
            return back()->withErrors([
                'receipt_lines_json' => "Receipt line #".($i+1).": description is required."
            ])->withInput();
        }

        if (!is_numeric($amt) || (float)$amt <= 0) {
            return back()->withErrors([
                'receipt_lines_json' => "Receipt line #".($i+1).": amount must be greater than 0."
            ])->withInput();
        }
    }
}

        $age = Carbon::parse($data['dob'])->diffInYears(now());
        if ($age < 18 || $age > 65) {
            return back()->withErrors(['dob' => 'Employee DOB invalid: accepted 18–65 only.'])->withInput();
        }

        // Dependent rules
        if ($data['claimType'] === "Dependent's Claim") {
            if (empty($data['depRel']) || empty($data['depDob'])) {
                return back()->withErrors(['depRel' => 'Dependent details required.'])->withInput();
            }

            $depAge = Carbon::parse($data['depDob'])->diffInYears(now());

            if ($data['depRel'] === 'Children') {
                if ($depAge < 14 || $depAge > 21) {
                    return back()->withErrors(['depDob' => 'Dependent child DOB invalid: 14–21 only.'])->withInput();
                }
            } else {
                if ($depAge < 18 || $depAge > 65) {
                    return back()->withErrors(['depDob' => 'Dependent spouse/parent DOB invalid: 18–65 only.'])->withInput();
                }
            }
        }

        if ($data['benefit'] === 'Major Medical') {
            if (!$request->filled('timeIn') || !$request->filled('timeOut')) {
                return back()->withErrors(['timeIn' => 'Major Medical: please set Time In and Time Out.'])->withInput();
            }

            $in  = Carbon::createFromFormat('H:i', $data['timeIn']);
                $out = Carbon::createFromFormat('H:i', $data['timeOut']);

                if ($out->lessThanOrEqualTo($in)) {
                    $out->addDay(); // treat as next day
                }

                $hours = $out->diffInMinutes($in) / 60;

                if ($hours < 6) {
                    return back()->withErrors(['timeOut' => 'Major Medical: Duration must be at least 6 hours.'])->withInput();
                }
        }
        $name = Str::lower(trim(preg_replace('/\s+/', ' ', $data['given'].' '.($data['middle'] ?? '').' '.$data['surname'])));
        $key  = $name.'|'.$data['dob'].'|'.Str::lower($data['benefit']).'|'.Str::lower($data['claimType']);

        $last = Claim::where('claim_key', $key)->latest('created_at')->first();
$occ  = 1;

$uiOcc = (int) ($data['claimOccurrence'] ?? 0);

if ($last) {
    $nextEligible = Carbon::parse($last->created_at)->addDays(90)->startOfDay();

    if (now()->lt($nextEligible)) {
        return back()->withErrors([
            'benefit' => "Duplicate claim detected. Next eligible on ".$nextEligible->toDateString()." (90-day rule)."
        ])->withInput();
    }

    $expected = (int) $last->occurrence + 1;

    if ($uiOcc && $uiOcc !== $expected) {
        return back()->withErrors([
            'claimOccurrence' => "Invalid claim occurrence. Expected {$expected}."
        ])->withInput();
    }

    $occ = $expected;
} else {
    // first claim must be 1
    if ($uiOcc && $uiOcc !== 1) {
        return back()->withErrors([
            'claimOccurrence' => "Invalid claim occurrence. Expected 1."
        ])->withInput();
    }
    $occ = 1;
}
        $receipts = $request->input('receipts', []);

        if (empty($receipts) && $request->filled('receipt_lines_json')) {
            $decoded = json_decode($request->input('receipt_lines_json'), true);
            $receipts = is_array($decoded) ? $decoded : [];
        }

        $receipts = collect($receipts)->map(function ($r) {
            return [
                'category'    => $r['category'] ?? $r['cat'] ?? '',
                'description' => $r['description'] ?? $r['desc'] ?? '',
                'amount'      => $r['amount'] ?? $r['amt'] ?? 0,
            ];
        })->filter(function ($r) {
            return trim((string)$r['category']) !== ''
                && trim((string)$r['description']) !== ''
                && (float)$r['amount'] > 0;
        })->values()->toArray();

        $total = collect($receipts)->sum(fn ($r) => (float) $r['amount']);

        return DB::transaction(function () use ($user, $data, $request, $receipts, $total, $key, $occ) {

            $claimCode = 'CLM-' . random_int(10000, 99999);

            $claim = Claim::create([
                'claim_code' => $claimCode,
                'hr_user_id' => $user->id,

                'employee_surname' => $data['surname'],
                'employee_given'   => $data['given'],
                'employee_middle'  => $data['middle'] ?? null,
                'employee_dob'     => $data['dob'],
                'civil_status'     => $data['civil'],

                'employment_status' => $data['empType'],
                'claim_type'        => $data['claimType'],
                'benefit'           => $data['benefit'],
                'claim_key'         => $key,
                'occurrence'        => $occ,

                'dependent_name'         => $data['depName'] ?? null,
                'dependent_relationship' => $data['depRel'] ?? null,
                'dependent_dob'          => $data['depDob'] ?? null,

                'room_date'          => $data['roomDate'] ?? null,
                'time_in'            => $data['timeIn'] ?? null,
                'time_out'           => $data['timeOut'] ?? null,
                'amount_per_receipt' => $data['amtPerReceipt'] ?? null,

                'status'       => 'Submitted',
                'total_amount' => round($total, 2),
            ]);

            foreach ($receipts as $r) {
                $claim->receipts()->create([
                    'category'    => $r['category'],
                    'description' => $r['description'],
                    'amount'      => $r['amount'],
                ]);
            }

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $label => $file) {
                    if (!$file) continue;

                    $path = $file->store("claims/{$claim->id}", 'public');

                    $claim->attachments()->create([
                        'label'    => (string) $label, 
                        'path'     => $path,
                        'original' => $file->getClientOriginalName(),
                    ]);
                }
            }

            return redirect()
            ->route('portal.dashboard') 
            ->with('success', "Claim submitted: {$claim->claim_code}");
        });
    }
     
    public function show(Request $request, Claim $claim)
    {
        if ($claim->hr_user_id !== $request->user()->id) abort(403);

        if (! $request->expectsJson()) {
            return redirect()->route('portal.dashboard');
        }

        $fullName = trim(
            ($claim->employee_given ?? '') . ' ' .
            ($claim->employee_middle ?? '') . ' ' .
            ($claim->employee_surname ?? '')
        );

        $analysisRows = $claim->receipts()
            ->get()
            ->map(fn ($r) => [
                'item' => $r->description,
                'cat'  => $r->category,
                'amt'  => (float) $r->amount,
            ])
            ->values();

        return response()->json([
            'id' => $claim->id,
            'name' => $fullName,
            'benefit' => $claim->benefit,
            'claimType' => $claim->claim_type,
            'status' => $claim->status,
            'occurrence' => (int) ($claim->occurrence ?? 1),

            'dateSubmitted' => optional($claim->created_at)->toDateString(),
            'agingDays' => $claim->created_at
            ? (int) $claim->created_at->startOfDay()->diffInDays(now()->startOfDay())
            : 0,

            'assessment' => $claim->assessment ?? null,
            'remarks' => $claim->remarks ?? null,

            'recomputationReason' => $claim->recomputation_reason ?? null,
            'recomputationRemarks' => $claim->recomputation_remarks ?? null,

            'total' => (float) ($claim->total_amount ?? 0),
            'recomputed' => $claim->recomputed_total !== null ? (float) $claim->recomputed_total : null,

            'analysisRows' => $analysisRows,
            'history' => [], // fill later if you have a history table
        ]);
    }

    public function analysis(Claim $claim)
{
    return redirect()->route('portal.dashboard', [
        'open_analysis' => $claim->id,
    ]);
}

public function destroy(Request $request, Claim $claim)
{
    if ($claim->hr_user_id !== $request->user()->id) {
    abort(403);
}

    $hours = $claim->created_at ? $claim->created_at->diffInHours(now()) : 9999;
    if ($hours > 24) {
        $msg = 'Delete is allowed only within 24 hours after submission.';
        return $request->expectsJson()
            ? response()->json(['message' => $msg], 422)
            : back()->withErrors(['delete' => $msg]);
    }

    DB::transaction(function () use ($claim) {

        // ✅ delete attachment files from storage + DB rows
        if (method_exists($claim, 'attachments')) {
            $claim->attachments()->get()->each(function ($a) {
                if (!empty($a->path)) {
                    Storage::disk('public')->delete($a->path);
                }
                $a->delete();
            });
        }

        if (method_exists($claim, 'receipts')) {
            $claim->receipts()->delete();
        }

        Storage::disk('public')->deleteDirectory("claims/{$claim->id}");

        $claim->delete();
    });

    $okMsg = 'Claim deleted successfully.';
    return $request->wantsJson()
    ? response()->json(['message' => $okMsg])
    : redirect()->route('portal.dashboard')->with('success', $okMsg);
}

public function checkDuplicate(Request $request)
    {
        $request->validate([
            'given' => 'required|string',
            'surname' => 'required|string',
            'middle' => 'nullable|string',
            'dob' => 'required|date',
            'benefit' => 'required|string',
            'claimType' => 'required|string',
        ]);

        $name = Str::lower(trim(preg_replace('/\s+/', ' ', 
    $request->given.' '.($request->middle ?? '').' '.$request->surname
)));

        $key = $name.'|'.$request->dob.'|'.
               Str::lower($request->benefit).'|'.
               Str::lower($request->claimType);

        $last = Claim::where('claim_key', $key)
                     ->latest('created_at')
                     ->first();

        if(!$last){
            return response()->json([
                'duplicate' => false,
                'eligible' => true,
                'suggested_occurrence' => 1,
                'next_eligible_at' => null,
            ]);
        }

        $nextEligible = Carbon::parse($last->created_at)->addDays(90)->startOfDay();
$eligible = now()->startOfDay()->gte($nextEligible);

return response()->json([
  'duplicate' => true,
  'eligible' => $eligible,
  'next_eligible_at' => $nextEligible->toDateString(),
  'suggested_occurrence' => (int) $last->occurrence + 1,
]);

        return response()->json([
            'duplicate' => true,
            'eligible' => $eligible,
            'next_eligible_at' => $nextEligible,
            'suggested_occurrence' => (int)$last->occurrence + 1,
        ]);
    }
    public function requestRecompute(Request $request, Claim $claim)
{
    if ($claim->hr_user_id !== $request->user()->id) abort(403);

    $data = $request->validate([
        'reason'  => ['required','string','max:120'],
        'remarks' => ['nullable','string','max:2000'],
    ]);

    if ($data['reason'] === 'Others' && empty(trim($data['remarks'] ?? ''))) {
        return response()->json(['message' => 'Remarks required when reason is Others.'], 422);
    }

    $claim->update([
        'recomputation_reason'  => $data['reason'],
        'recomputation_remarks' => $data['remarks'] ?? null,
        'status'                => 'Recomputation Requested',
    ]);

    return response()->json(['message' => 'Recomputation requested.']);
}
}