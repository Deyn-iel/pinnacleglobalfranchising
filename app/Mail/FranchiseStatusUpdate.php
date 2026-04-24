<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FranchiseStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $subjectLine;
    public $messageBody;

    /**
     * Create a new message instance.
     */
    public function __construct($applicant, $subjectLine, $messageBody)
    {
        $this->applicant = $applicant;
        $this->subjectLine = $subjectLine;
        $this->messageBody = $messageBody;
    }

    /**
     * Build email
     */
    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.franchise-status-update');
    }
}