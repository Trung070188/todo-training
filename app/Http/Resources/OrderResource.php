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

           return[
                'id' => $this->id,
                'user' => new UserResource($this->user),
                'order_status' => $this->order_status,
                'order_details' => OrderDetailResource::collection($this->orderDetails)
            ];
    }
}
