<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $admin_token;
    public $expiresAt;
    public $admin_email;

    /**
     * Create a new message instance.
     *
     * @param string $admin_token
     * @param \Illuminate\Support\Carbon $expiresAt
     * @param string $admin_email
     */
    public function __construct($admin_token, $expiresAt, $admin_email)
    {
        $this->admin_token = $admin_token;
        $this->expiresAt = $expiresAt;
        $this->admin_email = $admin_email;
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
            ->view('emails.admin.sendtoken')
            ->with([
                'admin_token' => $this->admin_token,
                'expiresAt' => $this->expiresAt,
                'admin_email' => $this->admin_email,
                'logoPath' => $logoPath,
            ]);
    }
}
