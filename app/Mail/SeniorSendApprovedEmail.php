<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeniorSendApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $firstName;
    public $lastName;
    public $oscaId;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $oscaId
     */
    public function __construct($email, $firstName, $lastName, $oscaId)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->oscaId = $oscaId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Application Status')
            ->view('emails.senior_citizen.sendapprovedemail')
            ->with([
                'email' => $this->email,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'oscaId' => $this->oscaId,
                'logoPath' => $logoPath,
            ]);
    }
}
