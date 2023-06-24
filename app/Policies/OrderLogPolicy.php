<?php

namespace App\Policies;

use App\Repositories\Users\User;

class OrderLogPolicy
{
    public function view(User $user): bool
    {
        if($user->policy('view','order_logs'))
        {
            return true;
        }
        return false;
    }
    public function show(User $user): bool
    {
        if($user->policy('show','order_logs'))
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
        if($user->policy('create','order_logs'))
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
        if($user->policy('update','order_logs'))
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
        if($user->policy('delete','order_logs'))
        {
            return true;
        }
        return false;

    }
}
