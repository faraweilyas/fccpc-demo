<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IDRequest extends Notification
{
    use Queueable;

    public $action;

    public $message;

    public $request_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $action, string $message, int $request_id)
    {
        $this->action   = $action;
        $this->message  = $message;
        $this->request_id  = $request_id;
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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'action'       => $this->action,
            'message'      => $this->message,
            'request_id'   => $this->request_id,
        ];
    }
}
