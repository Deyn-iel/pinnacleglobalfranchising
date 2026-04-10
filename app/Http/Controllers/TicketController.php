<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\TicketSubmittedMail;

use App\Mail\TicketApprovalRequestMail;

use App\Mail\TicketTransferredMail;
class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('ticket.main-ticket-dashboard', compact('tickets')) ->with('pageTitle', 'Ticket Dashboard');
    }
public function myTickets()
{
    $tickets = \App\Models\Ticket::where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('ticket.ticket-dashboard', compact('tickets'));
}

    public function create()
    {
        return view('ticket.create-ticket');
    }

    public function store(Request $request)
{
    $request->validate([
        'branch' => 'required|string|max:255',
        'description' => 'required|string',
        'department' => 'required',
        'priority' => 'required',
    ]);

    $ticket = null;

    DB::transaction(function () use ($request, &$ticket) {

        $year = now()->year;

        $lastTicket = Ticket::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->lockForUpdate()
            ->first();

        $nextNumber = $lastTicket
            ? intval(substr($lastTicket->ticket_no, -4)) + 1
            : 1;

        $ticketNo = 'TCK-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $ticket = Ticket::create([
            'ticket_no' => $ticketNo,
            'user_id' => Auth::id(),
            'subject' => $request->branch,
            'description' => $request->description,
            'department' => $request->department,
            'priority' => $request->priority,
            'status' => 'pending',
            'pending_at' => now(), // ✅ ADD THIS
        ]);
    });

    // ✅ SEND EMAIL HERE (OUTSIDE TRANSACTION)

    if($ticket){

        $mainEmails = explode(',', env('SUPPORT_NOTIFY_EMAILS'));

        // department email mapping
        $departmentMap = [
            'it' => env('IT_SUPPORT_EMAIL'),
            'hr' => env('HR_SUPPORT_EMAIL'),
            'smm' => env('SMM_SUPPORT_EMAIL'),
            'finance' => env('FINANCE_SUPPORT_EMAIL'),
            'admin-secretary' => env('ADMIN_SUPPORT_EMAIL'),
            'od' => env('OPERATIONS_DIRECTOR_SUPPORT_EMAIL'),
            'om' => env('OPERATIONS_MANAGER_SUPPORT_EMAIL'),
        ];

        $departmentEmail = $departmentMap[$ticket->department] ?? null;

        $emails = $mainEmails;

        if($departmentEmail){
            $emails[] = $departmentEmail;
        }

        try {

            if (!empty($emails)) {
                Mail::to($emails)->send(new TicketSubmittedMail($ticket));
            }

        } catch (\Throwable $e) {

            Log::error('Ticket email failed: ' . $e->getMessage());

        }
    }

    return redirect()->route('tickets.myTickets')
        ->with('success', 'Ticket submitted successfully.');
}


public function updateStatus(Request $request, Ticket $ticket)
{

    $request->validate([
        'status' => 'required|in:pending,in_progress,resolved',
    'resolution_justification' => 'nullable|string'
    ]);


// if($request->status === 'resolved'){

//     if(!$ticket->in_progress_at){
//         return back()->with('error','Ticket must be in progress first.');
//     }

//     if(empty($request->resolution_justification)){
//         return back()->with('error','Justification is required before resolving.');
//     }

//     $ticket->resolution_justification = $request->resolution_justification;
//     $ticket->resolved_at = now();
//     $ticket->status = 'resolved';

//     $ticket->save();


//     $mainEmails = explode(',', env('SUPPORT_NOTIFY_EMAILS'));

//     $departmentMap = [
//         'it' => env('IT_SUPPORT_EMAIL'),
//         'hr' => env('HR_SUPPORT_EMAIL'),
//         'smm' => env('SMM_SUPPORT_EMAIL'),
//         'finance' => env('FINANCE_SUPPORT_EMAIL'),
//         'admin-secretary' => env('ADMIN_SUPPORT_EMAIL'),
//         'od' => env('OPERATIONS_DIRECTOR_SUPPORT_EMAIL'),
//         'om' => env('OPERATIONS_MANAGER_SUPPORT_EMAIL'),
//     ];

//     $departmentEmail = $departmentMap[$ticket->department] ?? null;

//     $emails = $mainEmails;

//     if($departmentEmail){
//         $emails[] = $departmentEmail;
//     }

//     try {

//         if (!empty($emails)) {
//             Mail::to($emails)->send(
//                 new \App\Mail\TicketResolvedMail(
//                     $ticket,
//                     $request->resolution_justification
//                 )
//             );
//         }

//     } catch (\Throwable $e) {
//         Log::error('Resolved email failed: ' . $e->getMessage());
//     }

//     return back()->with('success', 'Ticket resolved successfully.');
// }

    $ticket->status = $request->status;
    $ticket->save();

    return back()->with('success', 'Status updated successfully.');
}

public function requestApproval(Request $request, $id)
{
    $request->validate([
        'justification' => 'required|string'
    ]);

    $ticket = Ticket::with('user')->findOrFail($id);

    // ✅ IMPORTANT: SET APPROVAL FLAG
    $ticket->approval_requested = true;
    $ticket->approval_requested_at = now();
    $ticket->save();

    // ✅ SEND EMAIL
    Mail::to($ticket->user->email)
        ->send(new TicketApprovalRequestMail($ticket, $request->justification));

    return response()->json(['success' => true]);
}

public function decline(Request $request, $id)
{
    $request->validate([
        'reason' => 'required|string'
    ]);

    $ticket = Ticket::with('user')->findOrFail($id);

    // ✅ UPDATE STATUS
    $ticket->status = 'in_progress';
    $ticket->approval_decline_reason = $request->reason;
    $ticket->approval_requested = false;
    $ticket->approved_at = null;

    $ticket->save();

    // ==========================
    // 🔥 SEND EMAIL TO DEPARTMENT
    // ==========================
    $departmentMap = [
        'it' => env('IT_SUPPORT_EMAIL'),
        'hr' => env('HR_SUPPORT_EMAIL'),
        'smm' => env('SMM_SUPPORT_EMAIL'),
        'finance' => env('FINANCE_SUPPORT_EMAIL'),
        'admin-secretary' => env('ADMIN_SUPPORT_EMAIL'),
        'od' => env('OPERATIONS_DIRECTOR_SUPPORT_EMAIL'),
        'om' => env('OPERATIONS_MANAGER_SUPPORT_EMAIL'),
    ];

    $departmentEmail = $departmentMap[$ticket->department] ?? null;

    try {

        if ($departmentEmail) {
            Mail::to($departmentEmail)->send(
                new \App\Mail\TicketDeclinedMail(
                    $ticket,
                    $request->reason
                )
            );
        }

    } catch (\Throwable $e) {

        Log::error('Decline email failed: ' . $e->getMessage());

    }

    return response()->json(['success' => true]);
}
public function approve($id)
{
    $ticket = Ticket::with('user')->findOrFail($id);

    $ticket->status = 'resolved';
    $ticket->approved_at = now();
    $ticket->approval_requested = false;
    $ticket->resolved_at = now();

    $ticket->save();

    // ==========================
    // 🔥 SEND EMAIL TO DEPARTMENT ONLY
    // ==========================
    $departmentMap = [
        'it' => env('IT_SUPPORT_EMAIL'),
        'hr' => env('HR_SUPPORT_EMAIL'),
        'smm' => env('SMM_SUPPORT_EMAIL'),
        'finance' => env('FINANCE_SUPPORT_EMAIL'),
        'admin-secretary' => env('ADMIN_SUPPORT_EMAIL'),
        'od' => env('OPERATIONS_DIRECTOR_SUPPORT_EMAIL'),
        'om' => env('OPERATIONS_MANAGER_SUPPORT_EMAIL'),
    ];

    $departmentEmail = $departmentMap[$ticket->department] ?? null;

    try {

        if ($departmentEmail) {
            Mail::to($departmentEmail)->send(
                new \App\Mail\TicketResolvedMail(
                    $ticket,
                    $ticket->resolution_justification ?? ''
                )
            );
        }

    } catch (\Throwable $e) {

        Log::error('Resolved email failed: ' . $e->getMessage());

    }

    return response()->json(['success' => true]);
}


public function transfer(Request $request, $id)
{
    $request->validate([
        'department' => 'required|string',
        'reason' => 'nullable|string'
    ]);

    $ticket = Ticket::findOrFail($id);

    $oldDept = $ticket->department;

    // ✅ update department
    // ✅ update department
$ticket->department = $request->department;

// ✅ RESET FULL STATE (IMPORTANT)
$ticket->status = 'pending';
$ticket->pending_at = now();

$ticket->in_progress_at = null;
$ticket->resolved_at = null;

$ticket->approval_requested = false;
$ticket->approval_requested_at = null;
$ticket->approved_at = null;
$ticket->approval_decline_reason = null;

// optional (clean reset)
$ticket->resolution_justification = null;

$ticket->save();

    // ==========================
    // 🔥 EMAIL SA NEW DEPARTMENT
    // ==========================
    $departmentMap = [
        'it' => env('IT_SUPPORT_EMAIL'),
        'hr' => env('HR_SUPPORT_EMAIL'),
        'smm' => env('SMM_SUPPORT_EMAIL'),
        'finance' => env('FINANCE_SUPPORT_EMAIL'),
        'admin-secretary' => env('ADMIN_SUPPORT_EMAIL'),
        'od' => env('OPERATIONS_DIRECTOR_SUPPORT_EMAIL'),
        'om' => env('OPERATIONS_MANAGER_SUPPORT_EMAIL'),
    ];

    $newEmail = $departmentMap[$ticket->department] ?? null;

    try {
        if ($newEmail) {
            Mail::to($newEmail)->send(
                new \App\Mail\TicketTransferredMail($ticket, $oldDept, $request->reason)
            );
        }
    } catch (\Throwable $e) {
        Log::error('Transfer email failed: ' . $e->getMessage());
    }

    return response()->json(['success' => true]);
}
}
