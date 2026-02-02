<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    // SHOW ALL TICKETS
    public function index()
{
    $tickets = Ticket::with('user')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('user_id');

    return view('admin.tickets.index', compact('tickets'));
}

    // UPDATE STATUS
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Ticket status updated.');
    }

    // DELETE TICKET
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return back()->with('success', 'Ticket deleted successfully.');
    }
}
