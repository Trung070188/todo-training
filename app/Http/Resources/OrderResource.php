<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        foreach ($this->orderDetails as $orderDetail)
        {
           $data[] = [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'order_status' => $this->order_status,
                "price" => $orderDetail->order_total * $orderDetail->product->product_price,
                "product_id" => $orderDetail->product_id,
                "product_name" =>  $orderDetail->product->product_name
            ];
        }
        return $data;
    }
}
