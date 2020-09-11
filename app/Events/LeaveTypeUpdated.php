<?php

namespace App\Events;

use App\Models\LeaveType;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeaveTypeUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * @var LeaveType
     */
    public $leaveType;

    /**
     * Create a new event instance.
     *
     * @param LeaveType $leaveType
     */
    public function __construct(LeaveType $leaveType)
    {
        $this->leaveType = $leaveType;
    }
}
