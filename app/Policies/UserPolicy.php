<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('View Employees');
    }


    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('Create Employees');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermission('Update Employees');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function deactivate(User $user)
    {
        return $user->hasPermission('Deactivate Employees');
    }
}
