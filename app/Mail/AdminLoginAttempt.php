<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminLoginAttempt extends Mailable
{
    use Queueable, SerializesModels;

    public $admin_email;
    public $admin_throttleTime;

    public function __construct($admin_email, $admin_throttleTime)
    {
        $this->admin_email = $admin_email;
        $this->admin_throttleTime = $admin_throttleTime;
    }

    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Account Login Attempt')
            ->view('emails.admin.loginattempt')
            ->with([
                'admin_email' => $this->admin_email,
                'admin_throttleTime' => $this->admin_throttleTime,
                'logoPath' => $logoPath,
            ]);
    }
}
