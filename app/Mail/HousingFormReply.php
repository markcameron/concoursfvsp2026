<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HousingFormReply extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Contact $contact,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'FVSP 2026 - Hébergement',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.housing-form-reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
