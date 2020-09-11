<?php

namespace App\Listeners;

use App\Events\EmployeeCreated;
use App\Models\EmploymentType;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttachCreatedEmployeeToLeaveTypes implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param \App\Events\EmployeeCreated $event
     * @return void
     */
    public function handle(EmployeeCreated $event)
    {
        $employmentType = EmploymentType::find($event->user->employment_type_id);

        if (is_null($employmentType)) {
            return;
        }

        foreach ($employmentType->leaveTypes as $leaveType) {
            if ($event->user->gender != $leaveType->gender && $leaveType->gender != 'All') continue;

            if (!$leaveType->employmentTypes->contains('id', $event->user->employment_type_id)) continue;

            $event->user->leaveBalances()->create([
                'leave_type_id' => $leaveType->id,
                'balance' => $leaveType->maximum_days
            ]);
        }
    }
}
