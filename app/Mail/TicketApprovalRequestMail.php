<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketApprovalRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
public $justification;

    /**
     * Create a new message instance.
     */
    public function __construct($ticket, $justification)
{
    $this->ticket = $ticket;
    $this->justification = $justification;
}

    /**
     * Build the message.
     */
    public function build()
{
    return $this->subject('Ticket Resolution Confirmation Required')
                ->view('emails.ticket_approval')
                ->with([
                    'ticket' => $this->ticket,
                    'justification' => $this->justification, 
                ]);
}
}