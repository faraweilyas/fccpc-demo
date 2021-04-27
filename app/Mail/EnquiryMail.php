<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;

    /**
     * Create a new message instance.
     *
     * @param object $enquiry
     * @return void
     */
    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (isset($this->enquiry->file))
        {
            return $this
                ->view('emails.applicant-enquiry')
                ->subject('Applicant Enquiry - '.config('app.name'))
                ->attach(
                    $this->enquiry->document->getRealPath(),
                    [
                        'as'   => $this->enquiry->document->getClientOriginalName(),
                        'mime' => $this->enquiry->document->getClientMimeType(),
                    ]
                );
        }

        return $this
            ->view('emails.applicant-enquiry')
            ->subject('Applicant Enquiry - '.config('app.name'));
    }
}
