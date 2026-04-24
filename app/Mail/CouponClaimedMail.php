<?php

namespace App\Mail;

use App\Models\Coupon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CouponClaimedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $coupon;
    public $customerName;

    public function __construct(Coupon $coupon, string $customerName)
    {
        $this->coupon = $coupon;
        $this->customerName = $customerName;
    }

    public function build()
    {
        return $this->subject('Congratulations! Your coupon has been successfully claimed')
                    ->view('emails.coupon-claimed');
    }
}