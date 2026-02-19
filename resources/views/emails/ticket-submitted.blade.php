<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>New Ticket Submitted</title>
  </head>

  <body style="margin:0; padding:0; background:#f3f4f6; font-family: Arial, sans-serif; line-height:1.6; -webkit-text-size-adjust:100%;">

    <!-- Full width wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f3f4f6; padding:0; margin:0;">
      <tr>
        <td align="center" style="padding:18px 12px;">

          <!-- Container -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:620px; width:100%;">
            <tr>
              <td style="padding:0;">

                <!-- Header -->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="background:#0b0f14; color:#ffffff; border-radius:14px; overflow:hidden;">
                  <tr>
                    <td style="padding:18px 18px;">
                      <div style="font-size:13px; opacity:.85;">Ticket Support System</div>
                      <div style="font-size:20px; font-weight:900; margin-top:4px;">
                        New Ticket Submitted
                      </div>
                    </td>
                  </tr>
                </table>

                <!-- Spacer -->
                <div style="height:12px; line-height:12px;">&nbsp;</div>

                <!-- Card -->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="background:#ffffff; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden;">
                  <tr>
                    <td style="padding:18px 18px;">

                      @php
                        $pri = strtolower($ticket->priority ?? '');
                        $priBg = $pri === 'high' ? '#fee2e2' : ($pri === 'medium' ? '#fef3c7' : '#dcfce7');
                        $priColor = $pri === 'high' ? '#991b1b' : ($pri === 'medium' ? '#92400e' : '#166534');
                      @endphp

                      <!-- Ticket line -->
                      <div style="font-size:14px; font-weight:900; color:#111827; margin:0 0 10px 0;">
                        Ticket: <span style="color:#111827;">{{ $ticket->ticket_no }}</span>
                      </div>

                      <!-- Badges (NO FLEX, responsive safe) -->
                      <div style="margin:0 0 12px 0;">
                        <span style="display:inline-block; padding:6px 10px; border-radius:999px; font-size:12px; font-weight:900; background:#eef2ff; color:#3730a3; margin:0 8px 8px 0;">
                          {{ ucfirst($ticket->department) }}
                        </span>

                        <span style="display:inline-block; padding:6px 10px; border-radius:999px; font-size:12px; font-weight:900; background:{{ $priBg }}; color:{{ $priColor }}; margin:0 8px 8px 0;">
                          Priority: {{ ucfirst($ticket->priority) }}
                        </span>

                        <span style="display:inline-block; padding:6px 10px; border-radius:999px; font-size:12px; font-weight:900; background:#e5e7eb; color:#111827; margin:0 8px 8px 0;">
                          Status: {{ ucfirst(str_replace('_',' ', $ticket->status ?? 'pending')) }}
                        </span>
                      </div>

                      <!-- Subject -->
                      <div style="margin-top:4px;">
                        <div style="font-size:12px; color:#6b7280; font-weight:700; letter-spacing:.3px; text-transform:uppercase;">
                          Branch / Subject
                        </div>
                        <div style="font-size:16px; font-weight:900; color:#111827; margin-top:4px;">
                          {{ $ticket->subject }}
                        </div>
                      </div>

                      <!-- Description -->
                      <div style="margin-top:6px;">
  <div style="font-size:12px; color:#6b7280; font-weight:700; letter-spacing:.3px; text-transform:uppercase;">
    Description / Concerns
  </div>

  <div style="
    border:1px solid #e5e7eb;
    border-radius:12px;
    background:#f9fafb;
    color:#111827;
    padding:0;
    margin-top:4px;
  ">
    <p style="
      margin:0;
      line-height:1.3;
      word-break:break-word;
      white-space:pre-wrap;
    ">
      {{ $ticket->description }}
    </p>
  </div>
</div>
                      <!-- Meta -->
                      <div style="margin-top:14px; border-top:1px solid #e5e7eb; padding-top:12px; font-size:13px; color:#374151;">
                        {{-- <div style="margin-bottom:4px;"><strong>Submitted By (User ID):</strong> {{ $ticket->user_id }}</div> --}}
                        <div><strong>Submitted At:</strong> {{ optional($ticket->created_at)->format('M d, Y h:i A') }}</div>
                      <!-- Footer -->
                <div style="text-align:center; color:#6b7280; font-size:12px; margin-top:14px; padding:0 8px;">
                  Ticket Support System.
                </div>
                    </div>

                    </td>
                  </tr>
                </table>

                

              </td>
            </tr>
          </table>
          <!-- /Container -->

        </td>
      </tr>
    </table>
    <!-- /Wrapper -->

  </body>
</html>
