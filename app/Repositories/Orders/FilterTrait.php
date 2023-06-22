<?php

namespace App\Repositories\Orders;
trait FilterTrait
{
    public function scopeName($query, $id)
    {
        if ($id) {
            return $query->where('user_id', $id);
        }
        return $query;
    }
}
