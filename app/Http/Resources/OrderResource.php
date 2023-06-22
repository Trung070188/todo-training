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
        foreach ($this->order_details as $order_detail)
        {
           $data[] = [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'order_total' => $this->order_total,
                'order_status' => $this->order_status,
                "price" => $this->order_total * $order_detail->product_price,
                "product_id" => $order_detail->product_id,
                "product_name" => $order_detail->product_name
            ];
        }
        return $data;
    }
}
