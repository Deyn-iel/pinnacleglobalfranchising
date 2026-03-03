<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Payslip Available</h2>

    <p>Hello,</p>

    <p>
        Your payslip for <strong>{{ $payslip->folder_key }}</strong> is attached to this email.
    </p>

    <p>
        If you have any questions, please contact the HR Department.
    </p>

    <br>

    <p>
        Thank you,<br>
        <strong>HR Department</strong>
    </p>
</body>
</html>