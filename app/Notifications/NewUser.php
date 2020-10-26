<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUser extends Notification implements ShouldQueue
{
    use Queueable;

    protected $default_password;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $default_password)
    {
        $this->email            = $email;
        $this->default_password = $default_password;   
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->line('New user account creation.')
                    ->line('An account has been created for you on our platform, click the login button to login.')
                    ->line('Login Credetials')
                    ->line('Email: '.$this->email)
                    ->line('Password: '.$this->default_password)
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
            //
        ];
    }
}