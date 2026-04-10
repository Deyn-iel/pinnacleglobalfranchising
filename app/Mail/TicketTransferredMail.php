<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TicketTransferredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $oldDept;
    public $reason;

    public function __construct(Ticket $ticket, $oldDept, $reason = null)
    {
        $this->ticket = $ticket;
        $this->oldDept = $oldDept;
        $this->reason = $reason;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📩 Ticket Transferred: ' . $this->ticket->ticket_no,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_transferred', // IMPORTANT
        );
    }

    public function attachments(): array
    {
        return [];
    }
}