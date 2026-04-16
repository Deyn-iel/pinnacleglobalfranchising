<h2 style="margin-bottom:10px;">Support Ticket Update</h2>

<p>Dear {{ $ticket->user->name }},</p>

<p>
Our {{ strtoupper($ticket->department) }} team has reviewed and addressed your concern for the ticket below:
</p>

<p style="font-size:16px;">
<strong>{{ $ticket->ticket_no }}</strong>
</p>

<!-- ✅ ADD THIS BLOCK -->
<div style="
margin-top:15px;
padding:12px;
background:#f4f6fb;
border-radius:6px;
">
  <strong>Resolution Details:</strong><br>
  {{ $justification ?? 'No additional details provided.' }}
</div>
<!-- ✅ END -->

<p style="margin-top:15px;">
Please confirm if your issue has been successfully resolved.
</p>

<p>
If everything is working fine, kindly click the button below to proceed and confirm your ticket.
</p>

<br>

<a href="{{ route('login') }}"
style="
display:inline-block;
background:#092257;
color:white;
padding:12px;
border-radius:8px;
text-decoration:none;
font-weight:600;
">
Login
</a>

<br><br>

<p>
After logging in, you can review your ticket and mark it as resolved.
</p>

<br>

<p>
Thank you,<br>
<strong>
{{ strtoupper($ticket->department) }} Support Team
</strong>
</p>