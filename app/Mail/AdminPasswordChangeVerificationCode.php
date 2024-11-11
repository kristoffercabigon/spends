<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminPasswordChangeVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $change_password_verification_code;

    /**
     * Create a new message instance.
     *
     * @param string $admin_change_password_verification_code
     */
    public function __construct($admin_change_password_verification_code)
    {
        $this->admin_change_password_verification_code = $admin_change_password_verification_code;
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
            ->view('emails.admin.verifyemailforchangepassword')
            ->with([
                'admin_change_password_verification_code' => $this->admin_change_password_verification_code,
                'logoPath' => $logoPath,
            ]);
    }
}
