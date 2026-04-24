<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color:#333; background:#f9f9f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        <h2 style="color:#0d3553; margin-bottom:10px;">
            Hello {{ $applicant->personal_full_name }},
        </h2>

        <p style="margin-bottom:20px;">
            {!! nl2br(e($messageBody)) !!}
        </p>

        <p style="margin-top:30px;">
            Thank you,<br>
            <strong>Franchise Team</strong>
        </p>

        <hr style="border:none; border-top:1px solid #eee; margin:25px 0;">

        <small style="color:gray;">
            This is an official message from the Franchise Team.
        </small>

    </div>

</body>
</html>