<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminComposeMessageEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageBody;
    public $attachmentPath;
    public $logoPath;

    public function __construct($subject, $messageBody, $attachmentPath = null)
    {
        $this->subject = $subject;
        $this->messageBody = $messageBody;
        $this->attachmentPath = $attachmentPath;
        $this->logoPath = public_path('images/mail_cover.png'); 
    }

    public function build()
    {
        $email = $this->subject($this->subject)
            ->view('emails.admin.composemessage')
            ->with([
                'messageBody' => $this->messageBody,
                'subject' => $this->subject,
                'logoPath' => $this->logoPath, 
            ]);

        if ($this->attachmentPath) {
            $email->attach(storage_path('app/public/' . $this->attachmentPath));
        }

        return $email;
    }
}
