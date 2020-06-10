<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintMail extends Mailable
{
    use Queueable, SerializesModels;

     public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data['document']) {
            return $this
                ->view('emails.applicant-complaint')
                ->subject(config('app.name').' Applicant Complaint')->attach($this->data['document']->getRealPath(),
                    [
                        'as'   => $this->data['document']->getClientOriginalName(),
                        'mime' => $this->data['document']->getClientMimeType(),
                    ]);
        } else {
            return $this
                ->view('emails.applicant-complaint')
                ->subject(config('app.name').' Applicant Complaint');
        }

    }
}
