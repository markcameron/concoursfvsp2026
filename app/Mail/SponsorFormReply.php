<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;

class SponsorFormReply extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Contact $contact,
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'FVSP 2026 - Sponsoring',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.sponsor-form-reply',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(base_path('/resources/attachments/FVSP_2026_Dossier_de_Parrainage_30.10.2025.pdf'))
                ->as('FVSP_2026_Dossier_de_Parrainage_30.10.2025.pdf')
                ->withMime('application/pdf'),
            Attachment::fromPath(base_path('/resources/attachments/FVSP_2026_Formulaire_de_Souscription.pdf'))
                ->as('FVSP_2026_Formulaire_de_Souscription.pdf')
                ->withMime('application/pdf'),
            Attachment::fromPath(base_path('/resources/attachments/FVSP_2025_Publicités_livret.pdf'))
                ->as('FVSP_2025_Publicités_livret.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
