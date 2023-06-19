<?php

namespace App\Policies;

use App\Repositories\Users\User;
use App\Repositories\Users\Enums\Roles;

class UserPolicy
{
    public function checkRole($array, $roleValue)
    {
        foreach ($array as $role)
        {
            if($role == $roleValue)
            {
                return true;
            }
        }
        return false;


    }
    public function queryUser($user)
    {
        $user = $user->user_roles()->pluck('role_id');
        return $user;
    }

    public function view(User $user): bool
    {


        if ($this->checkRole($this->queryUser($user), Roles::ADMIN->value)) {
            return true;
        }

        return false;
    }
    public function show(User $user): bool
    {

        if ($this->checkRole($this->queryUser($user), Roles::ADMIN->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($this->checkRole($this->queryUser($user), Roles::ADMIN->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {

        if ($this->checkRole($this->queryUser($user), Roles::ADMIN->value) || $user->id === $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if ($this->checkRole($this->queryUser($user), Roles::ADMIN->value) && $user->role !== $user->role) {
            return true;
        }

        return false;
    }

}
