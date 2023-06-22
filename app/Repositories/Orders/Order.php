<?php

namespace App\Repositories\Orders;

use App\Repositories\Orders\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'order_status'
        ];
    protected $casts = [
      'order_status' => OrderStatus::class
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }

}
