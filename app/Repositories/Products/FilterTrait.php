<?php

namespace App\Repositories\Products;
trait FilterTrait
{
    public function scopeName($query, $name)
    {
        if ($name) {
            return $query->where('product_name', 'like', "%${name}%");
        }
        return $query;
    }
}
