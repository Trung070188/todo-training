<?php

namespace App\Policies;

use App\Repositories\Users\User;

class OrderPolicy
{
    public function view(User $user): bool
    {
        if($user->policy('view','orders'))
        {
            return true;
        }
        return false;
    }
    public function show(User $user): bool
    {
        if($user->policy('show','orders'))
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
        if($user->policy('create','orders'))
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
        if($user->policy('update','orders'))
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
        if($user->policy('delete','orders'))
        {
            return true;
        }
        return false;

    }

    public function order(User $user): bool
    {
        if($user->policy('order','orders'))
        {
            return true;
        }
        return false;

    }

}
