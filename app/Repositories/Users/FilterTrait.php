<?php

namespace App\Repositories\Users;
trait FilterTrait
{
    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'like', "%${name}%");
        }
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if ($email) {
            return $query->where('email', 'like', "%${email}%");
        }
        return $query;
    }
}
