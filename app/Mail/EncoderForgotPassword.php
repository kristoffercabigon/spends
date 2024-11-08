<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EncoderForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $encoder_token;
    public $expiresAt;
    public $encoder_email;

    /**
     * Create a new message instance.
     *
     * @param string $encoder_token
     * @param \Illuminate\Support\Carbon $expiresAt
     * @param string $encoder_email
     */
    public function __construct($encoder_token, $expiresAt, $encoder_email)
    {
        $this->encoder_token = $encoder_token;
        $this->expiresAt = $expiresAt;
        $this->encoder_email = $encoder_email;
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
            ->view('emails.encoder.sendtoken')
            ->with([
                'encoder_token' => $this->encoder_token,
                'expiresAt' => $this->expiresAt,
                'encoder_email' => $this->encoder_email,
                'logoPath' => $logoPath,
            ]);
    }
}
