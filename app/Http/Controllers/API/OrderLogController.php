<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderLogResource;
use App\Repositories\Orders\OrderLog;
use App\Repositories\Orders\OrderLogRepository;
use Illuminate\Http\Request;

class OrderLogController extends Controller
{
    private $orderLogRepository;

    public function __construct(OrderLogRepository $orderLogRepository)
    {
        $this->orderLogRepository = $orderLogRepository;
    }


    public function index(Request $request)
    {
        try {
            $this->authorize('create', OrderLog::class);
            $orderLog =  $this->orderLogRepository->getByQuery($request->all());
            return OrderLogResource::collection($orderLog);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }


    public function destroy($id)
    {
        try {
            $this->authorize('delete', OrderLog::class);

            $this->orderLogRepository->delete($id);
            return response()->json(['message' => 'Ok']);

        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }
}
