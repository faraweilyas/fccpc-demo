<?php
namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUser extends Notification implements ShouldQueue
{
    use Queueable;

    public $action;

    public $message;

    public $user;

    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $action, string $message, User $user, string $password)
    {
        $this->action   = $action;
        $this->message  = $message;
        $this->user     = $user;
        $this->password = $password;
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
            ->subject("Your Mergers Account Credentials")
            ->greeting("Hello {$this->user->getFirstName()}!")
            ->line('An account has been created for you on the Mergers platform. You can now access the Platform to review merger cases assigned to you.')
            ->line('Login Credetials')
            ->line('Email: '.$this->user->email)
            ->line('Password: '.$this->password)
            ->action('Login', url('/login'))
            ->line('After login please update your password')
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
            'user_id'   => $this->user->id,
        ];
    }
}
