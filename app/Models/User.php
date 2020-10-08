<?php

namespace App\Models;

use App\Models\Traits\HasRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRole;

    /**
     * Status for a active user
     */
    const ACTIVE = 1;

    /**
     * Status for a deactivated user
     */
    const DEACTIVATED = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }

    public function leaveTypeBalance($leaveType)
    {
        return $this->leaveBalances()->where('leave_type_id', $leaveType)->first();
    }

    public function scopeInplaceUsers(Builder $query)
    {
        //Supervisor choose other supervisor from different department
       /* if (Auth::user()->isSupervisor()) {
            return $query->where("id", "<>", Auth::user()->id)
                ->where(function (Builder $query) {
                    $permission = 'Recommend Leave Requests';
                    $query->where('department_id', Auth::user()->department_id)
                        ->orWhereHas('role', function ($query) use ($permission) {
                            $query->whereHas('permissions', function ($query) use ($permission) {
                                $query->where('name', '=', $permission);
                            });
                        });
                });
        }*/

        return $query->where("id", "<>", Auth::user()->id)
            ->where('department_id', Auth::user()->department_id);
    }

    public function getFullnameAttribute()
    {
        return $this->name;
    }
}
