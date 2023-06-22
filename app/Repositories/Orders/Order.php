<?php

namespace App\Repositories\Orders;

use App\Repositories\Orders\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'order_total',
        'order_status'
        ];
    protected $casts = [
      'order_status' => OrderStatus::class
    ];
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }

}
