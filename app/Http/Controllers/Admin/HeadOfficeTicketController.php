<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class HeadOfficeTicketController extends Controller
{
    // SHOW ALL TICKETS
public function index($department)
{
    $tickets = Ticket::with('user')
        ->where('department', $department)
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('user_id');

    return view("admin.headoffice-portals.$department.ticket", compact('tickets'));
}

    // UPDATE STATUS
    // public function update(Request $request, Ticket $ticket)
    // {
    //     $request->validate([
    //         'status' => 'required|in:pending,in_progress,resolved',
    //     ]);

    //     $ticket->update([
    //         'status' => $request->status,
    //     ]);

    //     return back()->with('success', 'Ticket status updated.');
    // }

    // DELETE TICKET
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return back()->with('success', 'Ticket deleted successfully.');
    }

    public function markViewed(Ticket $ticket)
{
    // ❌ do nothing if already resolved
    if ($ticket->status === 'resolved') {
        return response()->json([
            'success' => false,
            'message' => 'Ticket already resolved'
        ]);
    }

    // change only if pending
    if ($ticket->status === 'pending') {
        $ticket->update([
            'status' => 'in_progress'
        ]);
    }

    return response()->json([
        'success' => true,
        'status' => $ticket->status
    ]);
}
}
