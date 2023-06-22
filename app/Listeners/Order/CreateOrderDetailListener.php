<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreateEvent;
use App\Repositories\Orders\OrderDetail;
use App\Repositories\Orders\OrderDetailRepository;

class CreateOrderDetailListener
{
    /**
     * Create the event listener.
     */
    private $detailRepository;
    public function __construct(OrderDetailRepository $detailRepository)
    {
        $this->detailRepository = $detailRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreateEvent $event)
    {
        $order = $event->order;
        $data = $event->data;
        $array= [];
        foreach ($data as $orderDetail)
        {
          $array = [
              'product_id' => $orderDetail['product_id'],
              'order_id' => $order['id'],
              'order_total' => $orderDetail['order_total'],
              'user_id' => $order['user_id']
            ];
           $array[] =  $this->detailRepository->create($array);

        }

        return $array;
    }
}
