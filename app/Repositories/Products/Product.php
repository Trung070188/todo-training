<?php

namespace App\Repositories\Products;

use App\Repositories\Products\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use FilterTrait;
    protected $fillable = [
        'product_name',
        'product_price',
        'product_image',
        'product_status'
    ];
    protected $casts =  [
        'status' => ProductStatus::class,
        ];

}
