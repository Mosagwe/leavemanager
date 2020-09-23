<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InplaceRequestNotification extends Notification
{
    use Queueable;

    /**
     * @var LeaveRequest
     */
    private $leaveRequest;

    /**
     * Create a new notification instance.
     *
     * @param LeaveRequest $leaveRequest
     */
    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Inplace Request')->markdown('mail.leave.inplace_request', [
                'user' => $notifiable,
                'leaveRequest' => $this->leaveRequest
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'leave_id' => $this->leaveRequest->id,
            'user_id' => $this->leaveRequest->user_id,
            'leave_type_id' => $this->leaveRequest->leave_type_id,
            'start_at' => $this->leaveRequest->start_at,
            'end_at' => $this->leaveRequest->end_at,
            'number_of_days' => $this->leaveRequest->number_of_days,
            
        ];
    }
}
