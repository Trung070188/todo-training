<?php

namespace App\Events\Order;

use App\Repositories\Orders\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $order;
    public $data;

    public function __construct(Order $order, $data)
    {
        $this->order = $order;
        $this->data = $data;
    }

}
