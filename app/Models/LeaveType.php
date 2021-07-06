<?php

namespace App\Models;

class LeaveType extends BaseModel
{
    public function employmentTypes()
    {
        return $this->belongsToMany(EmploymentType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'leave_balances','leave_type_id','user_id')->withPivot('balance');
    }


}
