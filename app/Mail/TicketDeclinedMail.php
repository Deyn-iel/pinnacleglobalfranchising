<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TicketDeclinedMail extends Mailable
{
    public $ticket;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct($ticket, $reason)
    {
        $this->ticket = $ticket;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('❌ Ticket Declined by User')
                    ->view('emails.ticket-declined')
                    ->with([
                        'ticket' => $this->ticket,
                        'reason' => $this->reason,
                    ]);
    }
}