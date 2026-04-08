<h2>Ticket Resolved</h2>

<p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>
<p><strong>Branch:</strong> {{ $ticket->subject }}</p>
<p><strong>Department:</strong> {{ strtoupper($ticket->department) }}</p>

<hr>

<p>This ticket has been marked as <strong>RESOLVED</strong>.</p>