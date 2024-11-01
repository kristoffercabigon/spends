<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeniorForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $expiresAt;
    public $email; 

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param \Illuminate\Support\Carbon $expiresAt
     * @param string $email
     */
    public function __construct($token, $expiresAt, $email)
    {
        $this->token = $token;
        $this->expiresAt = $expiresAt;
        $this->email = $email; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Password Reset Request') 
            ->view('emails.senior_citizen.sendtoken')
            ->with([
                'token' => $this->token,
                'expiresAt' => $this->expiresAt,
                'email' => $this->email, 
                'logoPath' => $logoPath,
            ]);
    }
}
