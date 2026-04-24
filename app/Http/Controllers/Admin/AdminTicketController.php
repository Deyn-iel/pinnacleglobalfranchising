<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index()
{
    $tickets = Ticket::with('user')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('user_id');

    return view('admin.tickets.index', compact('tickets'));
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
    if ($ticket->status === 'resolved') {
        return response()->json([
            'success' => false,
            'message' => 'Ticket already resolved'
        ]);
    }

    if ($ticket->status === 'pending') {

    $ticket->status = 'in_progress';

    $now = now();

    if (!$ticket->in_progress_at || $ticket->in_progress_at == $ticket->created_at) {
        $ticket->in_progress_at = $now;
    }

    $ticket->save();
    $ticket->refresh();
}

    return response()->json([
        'success' => true,
        'status' => $ticket->status,
        'in_progress_at' => $ticket->in_progress_at,
        'resolved_at' => $ticket->resolved_at,
    ]);
}
}

// <?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\Ticket;
// use Illuminate\Http\Request;

// class AdminTicketController extends Controller
// {
//     public function index()
// {
//     $tickets = Ticket::with('user')
//         ->orderBy('created_at', 'desc')
//         ->get()
//         ->groupBy('user_id');

//     return view('admin.tickets.index', compact('tickets'));
// }

//     public function update(Request $request, Ticket $ticket)
//     {
//         $request->validate([
//             'status' => 'required|in:pending,in_progress,resolved',
//         ]);

//         $ticket->update([
//             'status' => $request->status,
//         ]);

//         return back()->with('success', 'Ticket status updated.');
//     }

//     public function destroy(Ticket $ticket)
//     {
//         $ticket->delete();

//         return back()->with('success', 'Ticket deleted successfully.');
//     }
// }
