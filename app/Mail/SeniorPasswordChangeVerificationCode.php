<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeniorPasswordChangeVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $change_password_verification_code;

    /**
     * Create a new message instance.
     *
     * @param string $change_password_verification_code
     */
    public function __construct($change_password_verification_code)
    {
        $this->change_password_verification_code = $change_password_verification_code;
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
        ->view('emails.senior_citizen.verifyemailforchangepassword')
        ->with([
            'change_password_verification_code' => $this->change_password_verification_code,
            'logoPath' => $logoPath,
        ]);
    }
}
