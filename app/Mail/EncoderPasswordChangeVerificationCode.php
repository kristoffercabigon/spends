<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EncoderPasswordChangeVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $change_password_verification_code;

    /**
     * Create a new message instance.
     *
     * @param string $encoder_change_password_verification_code
     */
    public function __construct($encoder_change_password_verification_code)
    {
        $this->encoder_change_password_verification_code = $encoder_change_password_verification_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Change Password Request')
            ->view('emails.encoder.verifyemailforchangepassword')
            ->with([
            'encoder_change_password_verification_code' => $this->encoder_change_password_verification_code,
                'logoPath' => $logoPath,
            ]);
    }
}
