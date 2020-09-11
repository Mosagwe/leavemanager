<?php

namespace App\Listeners;

use App\Events\EmployeeCreated;
use App\Models\EmploymentType;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateEmployeeLeaveTypes implements ShouldQueue
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

       if(is_null($employmentType)){
           return;
       }

       foreach ($employmentType->leaveTypes as $leaveType){
           if ($event->user->leaveBalances->contains('leave_type_id', $leaveType->id)) {
               continue;
           }

           $event->user->leaveBalances()->create([
               'leave_type_id' => $leaveType->id,
               'balance' => $leaveType->max_days
           ]);
       }
    }
}
