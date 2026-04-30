<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminFranchiseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        $brand = $this->data['brand'] ?? 'Franchise';

        return new Envelope(
                subject: "New {$brand} Franchise Application Submitted",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-franchise-notification',
            with: [
                'data' => $this->data,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
