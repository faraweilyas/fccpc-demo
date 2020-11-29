<?php

namespace App\Notifications;

use App\Models\Cases;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyHandlerForDeficientCaseSubmission extends Notification
{
    use Queueable;

    public $action;

    public $message;

    public $case_id;

    public $application_no;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $action, string $message, Cases $case)
    {
        $this->action           = $action;
        $this->message          = $message;
        $this->case_id          = $case->id;
        $this->application_no   = $case->reference_number;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The applicant with this application reference number '.$this->application_no.', has uploaded and submitted requested deficient documents')
                    ->action('Login', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'action'    => $this->action,
            'message'   => $this->message,
            'case_id'   => $this->case_id,
        ];
    }
}
