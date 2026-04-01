<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketResolvedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
public $ticket;
public $justification;

public function __construct($ticket, $justification)
{
    $this->ticket = $ticket;
    $this->justification = $justification;
}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Ticket Resolved: ' . $this->ticket->ticket_no,
    );
}

    /**
     * Get the message content definition.
     */
   public function content(): Content
{
    return new Content(
        view: 'emails.ticket_resolved',
    );
}

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
