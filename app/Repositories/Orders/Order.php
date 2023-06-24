<?php

namespace App\Repositories\Orders;

use App\Repositories\Orders\Enums\OrderStatus;
use App\Repositories\Users\User;
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
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
