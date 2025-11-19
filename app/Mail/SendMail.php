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

    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data Data yang dikirim dari Controller
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Menggunakan title dari controller sebagai subjek
        return new Envelope(
            subject: $this->data['title'] ?? 'Pembaruan Status Pendaftaran Magang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // View email harus ada di resources/views/emails/status.blade.php
        return new Content(
            view: 'emails.status', 
            with: ['data' => $this->data],
        );
    }
}