<?php
namespace App\Repositories\Products;


use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $model;
    public function __construct(Product $products)
    {
        $this->model = $products;
    }


}
