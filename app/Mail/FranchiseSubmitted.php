<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FranchiseSubmitted extends Mailable
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
            subject: "Franchise Application Received - {$brand}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.franchise-submitted',
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
