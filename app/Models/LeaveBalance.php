<?php

namespace App\Models;

class LeaveBalance extends BaseModel
{
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
