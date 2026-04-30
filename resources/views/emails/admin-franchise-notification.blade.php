<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color:#333; background:#f9f9f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        <h2 style="color:#0d3553; margin-bottom:15px;">
            📩 New Franchise Application Submitted
        </h2>

        <p>
            A new applicant has successfully submitted a franchise application.
        </p>

        <div style="background:#f4f6f8; padding:15px; border-radius:8px; margin:20px 0;">
            <p style="margin:5px 0;"><strong>Name:</strong> {{ $data['personal_full_name'] }}</p>
            <p style="margin:5px 0;"><strong>Brand:</strong> {{ $data['brand'] ?? 'Kape-Ilokano' }}</p>
            <p style="margin:5px 0;"><strong>Email:</strong> {{ $data['email'] }}</p>
            <p style="margin:5px 0;"><strong>Contact:</strong> {{ $data['personal_contact'] }}</p>
            <p style="margin:5px 0;"><strong>Location:</strong> {{ $data['proposal_location'] }}</p>
        </div>

        <p>
            Please log in to the admin dashboard to review the complete application and proceed with the next steps.
        </p>

        <p style="margin-top:25px;">
            <strong>Kape-Ilokano System</strong>
        </p>

    </div>

</body>
</html>
