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

    public $case;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $action, string $message, Cases $case)
    {
        $this->action           = $action;
        $this->message          = $message;
        $this->case             = $case;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return (in_array($this->action, ["defresponse"]))
            ? ['database', 'mail']
            : ['database'];
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
            'case_id'   => $this->case->id,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->action == "defresponse" && $notifiable->isCaseHandler())
            return $this->deficiencyResponseToCaseHandler($notifiable);

        if ($this->action == "defresponse" && $notifiable->isSupervisor())
            return $this->deficiencyResponseToSupervisor($notifiable);
    }

    public function deficiencyResponseToCaseHandler($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("Deficient notification #{$this->case->reference_number} has been responded to.")
                    // ->action('Login', url('/login'))
                    ->line('Thank you.');
    }

    public function deficiencyResponseToSupervisor($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("Deficient notification #{$this->case->reference_number} has been responded to.")
                    // ->action('Login', url('/login'))
                    ->line('Thank you.');
    }
}
