<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color:#333;">

    <h2>New Franchise Application Submitted</h2>

    <p>A new applicant has submitted a franchise application.</p>

    <p><strong>Applicant Details:</strong></p>

    <ul>
        <li><strong>Name:</strong> {{ $data['personal_full_name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
        <li><strong>Contact:</strong> {{ $data['personal_contact'] }}</li>
        <li><strong>Location:</strong> {{ $data['proposal_location'] }}</li>
    </ul>

    <p>
        Please log in to the admin dashboard to review the full application.
    </p>

    <br>

    <p><strong>Kape-Ilokano System</strong></p>

</body>
</html>