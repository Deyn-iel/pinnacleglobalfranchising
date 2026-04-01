<h2>Ticket Resolved</h2>

<p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>
<p><strong>Subject:</strong> {{ $ticket->subject }}</p>
<p><strong>Department:</strong> {{ strtoupper($ticket->department) }}</p>

<hr>

<p><strong>Resolution Justification:</strong></p>
<p>{{ $justification }}</p>

<hr>

<p>This ticket has been marked as <strong>RESOLVED</strong>.</p>