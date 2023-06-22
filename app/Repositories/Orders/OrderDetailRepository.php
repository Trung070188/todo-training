<?php
namespace App\Repositories\Orders;
use App\Events\Order\OrderCreateEvent;
use App\Repositories\BaseRepository;
use App\Repositories\Users\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OrderDetailRepository extends BaseRepository
{
    protected $orderDetail;
    public function __construct(OrderDetail $orderDetails)
    {
        $this->model = $orderDetails;
    }
   public function delete($orderDetailIds): bool
   {
       return $this->getModel()->whereIn('id', $orderDetailIds)->delete();
   }
}
