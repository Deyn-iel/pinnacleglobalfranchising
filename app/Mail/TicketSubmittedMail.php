<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketSubmittedMail extends Mailable
{
    use SerializesModels;

    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('New Support Ticket Submitted')
                    ->view('emails.ticket-submitted');
    }
}
