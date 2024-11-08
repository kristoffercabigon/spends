<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeniorLoginAttempt extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $ipAddress;
    public $throttleTime;

    public function __construct($email, $ipAddress, $throttleTime)
    {
        $this->email = $email;
        $this->ipAddress = $ipAddress;
        $this->throttleTime = $throttleTime;
    }

    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Account Login Attempt') 
            ->view('emails.senior_citizen.loginattempt')
            ->with([
                'email' => $this->email,
                'ipAddress' => $this->ipAddress,
                'throttleTime' => $this->throttleTime,
                'logoPath' => $logoPath,
            ]);
    }
}
