<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color:#333; background:#f9f9f9; padding:20px;">

    <div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        <h2 style="color:#0d3553; margin-bottom:10px;">
            🎉 Congratulations, {{ $customerName }}!
        </h2>

        <p>
            You Have Successfully Purchased a Franchise Pinas Exclusive Discount Voucher
        </p>

        <p>
            Here are your claim details:
        </p>

        <div style="background:#f4f6f8; padding:15px; border-radius:8px; margin:20px 0;">
            <p style="margin:5px 0;"><strong>Coupon Code:</strong> {{ $coupon->unique_code }}</p>
            <p style="margin:5px 0;"><strong>Reward:</strong> {{ $coupon->claimable_item }}</p>
            <p style="margin:5px 0;"><strong>Claimed At:</strong> {{ $coupon->claimed_at?->format('M d, Y h:i A') }}</p>
        </div>

        <p>
            Thank you for claiming your coupon. Please keep this email for your reference.
        </p>

        <p style="font-weight:bold; color:#6b4f2a; margin-top:20px;">
            Enjoy your reward! ☕
        </p>

        <hr style="border:none; border-top:1px solid #eee; margin:25px 0;">

        <small style="color:gray;">
            This is an automated email. Please do not reply.
        </small>

    </div>

</body>
</html>