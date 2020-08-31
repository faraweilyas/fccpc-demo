<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeApplicant extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;

    public $case;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($guest, $case, $subject)
    {
        $this->guest   = $guest;
        $this->case    = $case;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.welcome-applicant')
            ->subject('Merger Application');
    }
}
