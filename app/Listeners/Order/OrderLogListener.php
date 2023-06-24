<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreateEvent;
use App\Events\Order\OrderLogEvent;
use App\Repositories\Orders\Enums\OrderStatus;
use App\Repositories\Orders\OrderDetail;
use App\Repositories\Orders\OrderDetailRepository;
use App\Repositories\Orders\OrderLogRepository;
use Carbon\Carbon;

class OrderLogListener
{
    /**
     * Create the event listener.
     */
    private $orderLogRepository;
    public function __construct(OrderLogRepository $orderLogRepository)
    {
        $this->orderLogRepository = $orderLogRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderLogEvent $event)
    {
        $localOrder = collect($event->localOrder);
        $originOrder = collect($event->originOrder);

        $differentElements = $localOrder->diffAssoc($originOrder);
        if(count($differentElements) > 0)
        {
            $localOrderStatus = OrderStatus::statusLog($localOrder['order_status']);
            $originOrderStatus = OrderStatus::statusLog($originOrder['order_status']);

            $differentElements['updated_at'] = Carbon::parse($differentElements['updated_at'])->format('Y/m/d H:i:s');

            $data = [
                'order_id' => $localOrder['id'],
                'message' => "update order status " .$localOrderStatus. ' -> '. $originOrderStatus . " update time " .$differentElements['updated_at']
            ];

          return  $this->orderLogRepository->create($data);

        }
    }
}
