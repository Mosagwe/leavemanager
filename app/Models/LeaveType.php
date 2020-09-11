<?php

namespace App\Models;

class LeaveType extends BaseModel
{
    public function employmentTypes()
    {
        return $this->belongsToMany(EmploymentType::class);
    }
}
