<?php

namespace App\Models;

class LeaveBalance extends BaseModel
{
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
