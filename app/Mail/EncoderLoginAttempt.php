<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EncoderLoginAttempt extends Mailable
{
    use Queueable, SerializesModels;

    public $encoder_email;
    public $encoder_ipAddress;
    public $encoder_throttleTime;

    public function __construct($encoder_email, $encoder_ipAddress, $encoder_throttleTime)
    {
        $this->encoder_email = $encoder_email;
        $this->encoder_ipAddress = $encoder_ipAddress;
        $this->encoder_throttleTime = $encoder_throttleTime;
    }

    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Account Login Attempt')
            ->view('emails.encoder.loginattempt')
            ->with([
                'encoder_email' => $this->encoder_email,
                'encoder_ipAddress' => $this->encoder_ipAddress,
                'encoder_throttleTime' => $this->encoder_throttleTime,
                'logoPath' => $logoPath,
            ]);
    }
}
