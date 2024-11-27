<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeniorPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $generatedPassword;

    /**
     * Create a new message instance.
     *
     * @param string $generatedPassword
     */
    public function __construct($generatedPassword)
    {
        $this->generatedPassword = $generatedPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Password')
            ->view('emails.senior_citizen.generatedpassword')
            ->with([
                'generatedPassword' => $this->generatedPassword,
                'logoPath' => $logoPath,
            ]);
    }
}
