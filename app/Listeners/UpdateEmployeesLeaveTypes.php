<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateEmployeesLeaveTypes implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param \App\Events\LeaveTypeCreated|\App\Events\LeaveTypeUpdated $event
     * @return void
     */
    public function handle($event)
    {
        $users = User::all();

        foreach ($users as $user) {
            // Do not update employees with existing leave types
            if ($user->leaveBalances->contains('leave_type_id', $event->leaveType->id)) continue;

            if ($user->gender != $event->leaveType->gender && $event->leaveType->gender != 'All') continue;

            if (!$event->leaveType->employmentTypes->contains('id', $user->employment_type_id)) continue;

            $user->leaveBalances()->create([
                'leave_type_id' => $event->leaveType->id,
                'balance' => $event->leaveType->maximum_days
            ]);
        }
    }
}
