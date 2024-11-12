<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeniorReferenceNumber extends Mailable
{
    use Queueable, SerializesModels;

    public $ncsc_rrn;

    /**
     * Create a new message instance.
     *
     * @param string $ncsc_rrn
     */
    public function __construct($ncsc_rrn)
    {
        $this->ncsc_rrn = $ncsc_rrn;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('images/mail_cover.png');

        return $this->subject('Reference Number')
            ->view('emails.senior_citizen.requesttracker')
            ->with([
                'ncsc_rrn' => $this->ncsc_rrn,
                'logoPath' => $logoPath,
            ]);
    }
}
