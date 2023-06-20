<?php

namespace App\Policies;

use App\Repositories\Users\User;

class UserPolicy
{
    public function view(User $user): bool
    {
        if($user->policy('view'))
        {
            return true;
        }
        return false;
    }
    public function show(User $user): bool
    {
        if($user->policy('show'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->policy('create'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if($user->policy('update'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if($user->policy('delete'))
        {
            return true;
        }
        return false;

    }

}
