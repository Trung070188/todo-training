<?php

namespace App\Policies;

use App\Repositories\Users\User;
use App\Repositories\Users\Enums\Roles;

class UserPolicy
{
    public function view(User $user): bool
    {

        if ($user->checkRole($user->queryUser(), Roles::ADMIN->value)) {
            return true;
        }

        return false;
    }
    public function show(User $user): bool
    {

        if ($user->checkRole($user->queryUser(), Roles::ADMIN->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->checkRole($user->queryUser(), Roles::ADMIN->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {

        if ($user->checkRole($user->queryUser(), Roles::ADMIN->value) || $user->id === $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if ($user->checkRole($user->queryUser(), Roles::ADMIN->value) && $user->role !== $user->role) {
            return true;
        }

        return false;
    }

}
