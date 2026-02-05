<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

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
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
        'department' => 'required',
        'priority' => 'required',
    ]);

    DB::transaction(function () use ($request) {

        $year = now()->year;

        $lastTicket = Ticket::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->lockForUpdate()
            ->first();

        $nextNumber = $lastTicket
            ? intval(substr($lastTicket->ticket_no, -4)) + 1
            : 1;

        $ticketNo = 'TCK-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Ticket::create([
            'ticket_no' => $ticketNo,
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'department' => $request->department,
            'priority' => $request->priority,
            'status' => 'pending',
        ]);
    });

    return redirect()->route('tickets.dashboard')
        ->with('success', 'Ticket submitted successfully.');
}

public function updateStatus(Request $request, Ticket $ticket)
{
    if($ticket->status === 'resolved'){
    return back()->with('success','Ticket is already resolved.');
}

    // ✅ owner lang pwede
    abort_if($ticket->user_id !== Auth::id(), 403);

    $request->validate([
        'status' => 'required|in:pending,in_progress,resolved',
    ]);

    $ticket->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Ticket status updated successfully.');
}

}
