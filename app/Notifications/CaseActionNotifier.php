<?php

namespace App\Notifications;

use App\Models\Cases;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CaseActionNotifier extends Notification
{
    use Queueable;

    public $action;

    public $message;

    public $case_id;

    public $case;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $action, string $message, int $case_id, $case=NULL)
    {
        $this->action   = $action;
        $this->message  = $message;
        $this->case_id  = $case_id;
        $this->case     = $case;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return (in_array($this->action, ["assign", "newcase", "request", "request_approved", "request_rejected", "newenquiry"]))
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
            'case_id'   => $this->case_id,
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
        if ($this->action == "assign" && $notifiable->isCaseHandler())
            return $this->newNotificationToCaseHandler($notifiable);

        if ($this->action == "newcase" && $notifiable->isSupervisor())
            return $this->newNotificationToSupervisor($notifiable);

        if ($this->action == "request" && $notifiable->isSupervisor())
            return $this->approvalRequestToSupervisor($notifiable);

        if (in_array($this->action, ['request_approved', 'request_rejected']) && $notifiable->isCaseHandler())
            return $this->recommendationFeedbackToCaseHandler($notifiable);

        if ($this->action == "newenquiry" && $notifiable->isSupervisor())
            return $this->newPreNotificationEnquiryToSupervisor($notifiable);
    }

    public function newNotificationToCaseHandler($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("A new case has been assigned to you.")
                    ->line('Thank you.');
    }

    public function newNotificationToSupervisor($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("A new notification has been filed – {$this->case->subject} & {$this->case->getCasePartiesText()}.")
                    ->line('Thank you.');
    }

    public function recommendationFeedbackToCaseHandler($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("You have received feedback on {$this->case->reference_number} from the supervisor.")
                    ->line('Thank you.');
    }

    public function approvalRequestToSupervisor($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("Case handler has requested for approval {$this->case->subject} & {$this->case->getCasePartiesText()}.")
                    ->line('Thank you.');
    }

    public function newPreNotificationEnquiryToSupervisor($notifiable)
    {
        return (new MailMessage)
                    ->subject(strip_tags(($this->message)))
                    ->greeting("Dear {$notifiable->getFirstName()},")
                    ->line("A new pre-notification enquiry has been submitted. {$this->case->subject} & {$this->case->firm}.")
                    ->line('Thank you.');
    }
}
