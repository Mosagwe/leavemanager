<?php

namespace App\Models;

class EmploymentType extends BaseModel
{
    public function leaveTypes()
    {
        return $this->belongsToMany(LeaveType::class);
    }
}
