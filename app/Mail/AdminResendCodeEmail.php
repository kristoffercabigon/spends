<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResendCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;
    public $expirationTime;

    /**
     * Create a new message instance.
     *
     * @param string $verificationCode
     * @param \Illuminate\Support\Carbon $expirationTime
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

        return $this->subject('Resend Verification Code')
            ->view('emails.admin.resendcode')
            ->with([
                'verificationCode' => $this->verificationCode,
                'expirationTime' => $this->expirationTime,
                'logoPath' => $logoPath,
            ]);
    }
}
