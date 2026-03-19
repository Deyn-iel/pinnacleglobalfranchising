<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>New Ticket</title>
</head>

<body style="margin:0;padding:0;background:#f5f5f5;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f5f5;padding:20px 0;">
<tr>
<td align="center">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff;border:1px solid #ddd;border-radius:8px; padding:10px;">
<tr>
<td style="padding:25px;">

<h2 style="margin-top:0;">New Ticket Submitted</h2>

<p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>

<p><strong>Submitted By:</strong> {{ $ticket->user->name }}</p>

<p><strong>Branch:</strong> {{ ucfirst(str_replace('_',' ', $ticket->subject)) }}</p>

<p><strong>Department:</strong> {{ ucfirst($ticket->department) }}</p>

<p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>

<p><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $ticket->status ?? 'pending')) }}</p>

<p style="margin-top:20px;"><strong>Concern Details:</strong></p>

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f5f5f5;border-radius:6px;">
<tr>
<td style="padding:12px;">
{{-- {{ $ticket->description }} --}}.........
</td>
</tr>
</table>

<p style="margin-top:15px;">
<strong>Submitted At:</strong>
{{ optional($ticket->created_at)->format('M d, Y h:i A') }}
</p>

</td>
</tr>

<!-- BUTTON SECTION -->
<tr>
<td align="center" style="padding:20px;">

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td align="center" bgcolor="#000000" style="border-radius:6px;">
<a href="{{ url('/login') }}"
style="display:inline-block;padding:12px 24px;color:#ffffff;text-decoration:none;font-weight:bold;">
Log in to view tickets <br>(desktop/laptop only).
</a>
</td>
</tr>
</table>

</td>
</tr>

<tr>
<td style="padding:15px;text-align:center;font-size:12px;color:#777;">
Ticket Support System
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>