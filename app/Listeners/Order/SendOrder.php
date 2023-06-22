<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use App\Repositories\Orders\OrderDetail;

class SendOrder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        $data = $event->data;
        $orderDetail =  OrderDetail::create([
            'order_id' => $order['id'],
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'product_price' => $data['product_price']
        ]);
        return $orderDetail;
    }
}
