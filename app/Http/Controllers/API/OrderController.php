<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Orders\Order;
use App\Repositories\Users\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderrepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderrepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('view', Order::class);
            $query = $request->query();
            $orders = $this->orderrepository->getByQuery($query);
            return OrderResource::collection($orders);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreateRequest $request)
    {
        try {
            $this->authorize('create', Order::class);
            $input = $request->all();
            $order = $this->orderrepository->create($input);
            return new OrderResource($order);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $this->authorize('show', Order::class);
            $order = $this->orderrepository->show($id);
            return new OrderResource($order);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        try {
            $this->authorize('update', Order::class);
            $input = $request->all();
            $order = $this->orderrepository->update($id, $input);
            return new OrderResource($order);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       try {
            $this->authorize('delete', Order::class);
            $this->orderrepository->delete($id);
            return response()->json(['message' => 'OK']);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }
}
