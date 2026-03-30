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

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
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

    return redirect()->route('tickets.dashboard')
        ->with('success', 'Ticket submitted successfully.');
}


public function updateStatus(Request $request, Ticket $ticket)
{
    if($ticket->status === 'resolved'){
        return back()->with('success','Ticket is already resolved.');
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,resolved',
    ]);

    // ❌ users cannot set in_progress
    if($request->status === 'in_progress'){
        return back()->with('success','Only admin can set ticket to In Progress.');
    }

if($request->status === 'resolved'){

    // ❗ IMPORTANT: make sure may in_progress muna
    if(!$ticket->in_progress_at){
        return back()->with('error','Ticket must be in progress first.');
    }

    // ✅ STOP IN PROGRESS TIMER
    $ticket->resolved_at = now();
}

    $ticket->status = $request->status;
    $ticket->save();

    return back()->with('success', 'Ticket resolved successfully.');
}

public function requestApproval($id)
{
    $ticket = Ticket::with('user')->findOrFail($id);

    Log::info("Sending approval email to: " . $ticket->user->email);

    Mail::to($ticket->user->email)
        ->send(new TicketApprovalRequestMail($ticket));

    return response()->json(['success' => true]);
}

}
