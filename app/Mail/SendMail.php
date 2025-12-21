<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Variabel publik agar bisa diakses di dalam view emailku.blade.php
     */
    public $data;

    /**
     * Create a new message instance.
     * Menerima array data dari DataPendaftaranController
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope (Mengatur Subjek Email).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'] ?? 'Update Status Pendaftaran Magang',
        );
    }

    /**
     * Get the message content definition (Mengatur File Tampilan Email).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emailku', // Pastikan file ini ada di resources/views/emailku.blade.php
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}