<?php

namespace App\Policies;

use App\Repositories\Users\User;
use App\Repositories\Users\Enums\Roles;

class UserPolicy
{

    public function show(User $user): bool
    {

        if ($user->role === Roles::ADMIN->value ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->role === Roles::ADMIN ) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $targetUser): bool
    {

        if ($user->role === Roles::ADMIN->value || $user->id === $targetUser->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $targetUser): bool
    {
        if ($user->role === Roles::ADMIN->value && $user->role !== $targetUser->role) {
            return true;
        }

        return false;
    }

}
