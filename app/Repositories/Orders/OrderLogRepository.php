<?php
namespace App\Repositories\Orders;
use App\Events\Order\OrderCreateEvent;
use App\Repositories\BaseRepository;
use App\Repositories\Users\User;
use Illuminate\Support\Facades\Auth;

class OrderLogRepository extends BaseRepository
{
    protected $model;
    public function __construct(OrderLog $orderLog)
    {
        $this->model = $orderLog;
    }
}
