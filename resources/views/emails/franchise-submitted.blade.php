<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color:#333; background:#f9f9f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        <h2 style="color:#0d3553; margin-bottom:10px;">
            🎉 Congratulations, {{ $data['personal_full_name'] }}!
        </h2>

        <p>
            Thank you for submitting your franchise application to
            <b>{{ strtoupper($data['brand'] ?? 'KAPE-ILOKANO') }}</b>.
        </p>

        <p>
            We are pleased to inform you that your application has been successfully received 
            and is now under review by our team.
        </p>

        <p>
            We appreciate your interest in becoming part of our growing family, and we will 
            contact you soon regarding the next steps.
        </p>

        <p style="font-weight:bold; color:#6b4f2a; margin-top:20px;">
            Let’s brew success, Naimas a Kape! ☕
        </p>

        <hr style="border:none; border-top:1px solid #eee; margin:25px 0;">

        <small style="color:gray;">
            This is an automated email. Please do not reply.
        </small>

    </div>

</body>
</html>
