<?php

namespace App\Repositories\Orders;

use App\Repositories\Products\Product;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_quantity',
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
