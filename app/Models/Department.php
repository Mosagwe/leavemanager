<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Department extends BaseModel
{
    public function approvers()
    {
        return $this->hasMany(User::class)->whereHas('role', function (Builder $query) {
            $query->whereHas('permissions', function (Builder $query){
                $query->where('name', 'Approve Leave Requests');
            });
        });
    }
}
