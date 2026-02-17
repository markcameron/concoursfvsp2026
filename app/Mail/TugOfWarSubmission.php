<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TugOfWarSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'FVSP 2026 - Inscription Tir au tuyau',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.tug-of-war-submission',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
