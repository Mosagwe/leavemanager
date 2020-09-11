<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestRecommendedNotification extends Notification implements ShouldQueue
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Leave Request Recommended')->markdown('mail.leave.recommended', [
            'user' => $notifiable,
            'leaveRequest' => $this->leaveRequest
        ]);
    }
}
