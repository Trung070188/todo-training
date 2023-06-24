<?php

namespace App\Events\Order;

use App\Repositories\Orders\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $localOrder;
    public $originOrder;

    public function __construct($localOrder, $originOrder)
    {
        $this->localOrder = $localOrder;
        $this->originOrder = $originOrder;
    }

}
