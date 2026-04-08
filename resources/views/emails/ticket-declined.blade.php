<h2>Ticket Declined ❌</h2>

<p>The user has declined the resolution of the ticket.</p>

<hr>

<p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>
<p><strong>Branch:</strong> {{ $ticket->subject }}</p>
<p><strong>Department:</strong> {{ ucfirst($ticket->department) }}</p>

<hr>

<p><strong>Reason for Decline:</strong></p>
<p>{{ $reason }}</p>

<hr>

<p>Please review and take further action.</p>