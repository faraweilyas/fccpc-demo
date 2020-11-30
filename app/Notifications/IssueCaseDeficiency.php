<?php

namespace App\Notifications;

use App\Models\Cases;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IssueCaseDeficiency extends Notification
{
    use Queueable;

    public $action;

    public $message;

    public $case_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $action, string $message, int $case_id)
    {
        $this->action   = $action;
        $this->message  = $message;
        $this->case_id  = $case_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //
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
