<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeniorVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;
    public $expirationTime; 

    /**
     * Create a new message instance.
     *
     * @param string $verificationCode
     * @param \Carbon\Carbon $expirationTime 
     */
    public function __construct($verificationCode, $expirationTime)
    {
        $this->verificationCode = $verificationCode;
        $this->expirationTime = $expirationTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Email Verification')
            ->view('emails.senior_citizen.verification')
            ->with([
                'verificationCode' => $this->verificationCode,
                'expirationTime' => $this->expirationTime,
                'logoPath' => $logoPath,
            ]);
    }
}
