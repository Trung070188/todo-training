<?php

namespace App\Repositories\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable = [
      'order_id',
      'message',
      'created_at',
      'updated_at'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

}
