<?php

namespace App\Mail;

use App\Models\Payslip;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayslipMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payslip;

    public function __construct(Payslip $payslip)
    {
        $this->payslip = $payslip;
    }

    public function build()
    {
        return $this->subject('Your Payslip - ' . $this->payslip->folder_key)
            ->view('emails.payslip')
            ->attach(
                storage_path('app/public/' . $this->payslip->file_path),
                [
                    'as' => $this->payslip->original_name,
                ]
            );
    }
}