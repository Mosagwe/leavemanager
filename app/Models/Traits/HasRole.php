<?php

namespace App\Models\Traits;

use App\Models\Department;
use App\Models\EmploymentType;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

trait HasRole
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        return $this->role->name === $role;
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }

    public function isAdministrator()
    {
        return $this->role->name == "Administrator";
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }

    public function isSupervisor()
    {
        return $this->hasPermission('Recommend Leave Requests');
    }

    public function departmentHasApprover()
    {
        return $this->department->approvers()->exists();
    }

    public static function withPermission($permission, $department = null, $excludeSelf = true)
    {
        $query = self::whereHas('role', function ($query) use ($permission) {
            $query->whereHas('permissions', function ($query) use ($permission) {
                $query->where('name', '=', $permission);
            });
        });

        if (!is_null($department)) {
            $query->where('department_id', '=', $department);
        }

        if ($excludeSelf) {
            $query->where('id', '<>', Auth::user()->id);
        }

        return $query;
    }

    public static function supervisors()
    {
        return self::withPermission('Recommend Leave Requests', Auth::user()->department_id, true)->get();
    }

    public static function approvers()
    {
        return self::withPermission('Approve Leave Requests')->get();
    }

    public static function hr()
    {
        return self::withPermission('HR')->get();
    }
}
