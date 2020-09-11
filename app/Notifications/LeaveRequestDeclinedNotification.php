<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestDeclinedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $password;
    /**
     * @var LeaveRequest
     */
    private $leaveRequest;
    /**
     * @var string
     */
    private $reason;

    /**
     * Create a new notification instance.
     *
     * @param LeaveRequest $leaveRequest
     * @param $reason
     */
    public function __construct(LeaveRequest $leaveRequest, string $reason)
    {
        $this->leaveRequest = $leaveRequest;
        $this->reason = $reason;
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
        return (new MailMessage)->subject('Leave Request Declined')
            ->markdown('mail.employee.declined', [
                'user' => $notifiable,
                'leaveRequest' => $this->leaveRequest,
                'reason' => $this->reason
            ]);

    }
}
