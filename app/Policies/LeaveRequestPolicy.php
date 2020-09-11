<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaveRequestPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    public function viewApproved(User $user)
    {
        return $user->hasPermission('View Approved Requests');
    }

    public function recommend(User $user)
    {
        return $user->hasPermission('Recommend Leave Requests');
    }

    public function approve(User $user)
    {
        return $user->hasPermission('Approve Leave Requests');
    }
}
