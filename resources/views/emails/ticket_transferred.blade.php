<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>📩 Ticket Transferred</h2>

    <p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>
    <p><strong>From Department:</strong> {{ strtoupper($oldDept) }}</p>
    <p><strong>To Department:</strong> {{ strtoupper($ticket->department) }}</p>
    <p><strong>Branch:</strong> {{ $ticket->subject }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>

    <hr>

    <p><strong>Concern:</strong></p>
    <p>.....</p>

    @if($reason)
        <hr>
        <p><strong>Transfer Reason:</strong></p>
        <p>{{ $reason }}</p>
    @endif

    <br>

    <p>Please take action on this ticket.</p>

    <br>

    <a href="{{ route('login') }}"
style="
display:inline-block;
background:#092257;
color:white;
padding:12px 18px;
border-radius:8px;
text-decoration:none;
font-weight:600;
">
Login
</a>

</body>
</html>