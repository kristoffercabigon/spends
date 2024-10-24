<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;

    /**
     * Create a new message instance.
     *
     * @param string $verificationCode
     */
    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verificationLink = url('/verify-email?code=' . $this->verificationCode);
        $logoPath = public_path('images/mail_cover.png'); 

        return $this->subject('Email Verification')
            ->view('emails.verification')
            ->with([
                'verificationLink' => $verificationLink,
                'logoPath' => $logoPath, 
            ]);
    }
}
