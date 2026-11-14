<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        $subject = $this->details['subject'] ?? ('Kode verifikasi Anda: ' . ($this->details['otp'] ?? ''));
        $fromAddress = config('mail.from.address', 'yanbilkis85@gmail.com');
        $fromName    = config('mail.from.name', 'Sistem Magang');

        return $this->from($fromAddress, $fromName)
                    ->subject($subject)
                    ->view('emails.otp')
                    ->text('emails.otp_plain');
    }
}