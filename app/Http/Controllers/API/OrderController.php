<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderLogStatusRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Repositories\Orders\OrderRepository;
use App\Repositories\Orders\Order;
use App\Repositories\Users\User;
use Illuminate\Http\Request;

/**
 * @group Order
 *
 * APIs for managing Order
 *
 * @header Content-Type application/json
 * @authenticated
 */
class OrderController extends Controller
{
    private $orderrepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderrepository = $orderRepository;
    }
    /**
     * View order
     *
     * Data trả về list danh sách product
     *
     *  @response 201
     * "data": {
     *   "id": 106,
     *   "user_id": 1,
     *   "order_status": 1,
     *   "price": 2000,
     *   "product_id": 1,
     *   "product_name": "Ban"
     * },
     *  { "id": 107,
     *   "user_id": 1,
     *   "order_status": 1,
     *   "price": 2000,
     *   "product_id": 1,
     *   "product_name": "Ban"
     * }
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
     * Create order
     *
     * Kết quả trả về file json order
     * Truyền vào một mảng gồm nhiều sản phẩm
     * @bodyParam product_quantity int :là số lượng sản phẩm required Example: 1
     * @bodyParam product_id : là id của sản phầm int required Example: 1
     *
     *@response 201 {
     * "data": [
     * {
     *  "id": 106,
     *  "user": {
     *  "id" : 1,
     *  "name" : "admin"
     *  "email" : "admin@gmail.com"
     * },
     *  "order_details": [
     *  "id": 1,
     *  "order_id" : 107,
     *  "product" : [
     * {
     *      "id" :1,
     *      "product_name" :"Bàn"
     *      "product_price" : 1000
     *      "product_image" :"xxxx"
     * },
     * {
     *      "id" :2,
     *      "product_name" :"Ghế"
     *      "product_price" : 2000
     *      "product_image" :"xxxx"
     * }
     * ],
     * ]
     * },
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
     * show order
     *
     * Kết quả trả về file json order
     * Truyền Id của order
     * @queryParam id int required Example : 1
     *
     *@response 201 {
     * "data": [
     * {
     *  "id": 106,
     *  "user": {
     *  "id" : 1,
     *  "name" : "admin"
     *  "email" : "admin@gmail.com"
     * },
     *  "order_details": [
     *  "id": 1,
     *  "order_id" : 107,
     *  "product" : [
     * {
     *      "id" :1,
     *      "product_name" :"Bàn"
     *      "product_price" : 1000
     *      "product_image" :"xxxx"
     * },
     * {
     *      "id" :2,
     *      "product_name" :"Ghế"
     *      "product_price" : 2000
     *      "product_image" :"xxxx"
     * }
     * ],
     * ]
     * },
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
     * update order
     *
     * Kết quả trả về file json order
     *
     * @queryParam id : là id của order int required Example : 1
     * @bodyParam  order_status : mặc định là 1 int Example : 2
     *@response 201 {
     * "data": [
     * {
     *  "id": 106,
     *  "user": {
     *  "id" : 1,
     *  "name" : "admin"
     *  "email" : "admin@gmail.com"
     * },
     *  "order_details": [
     *  "id": 1,
     *  "order_id" : 107,
     *  "order_status" : 2
     *  "product" : [
     * {
     *      "id" :1,
     *      "product_name" :"Bàn"
     *      "product_price" : 1000
     *      "product_image" :"xxxx"
     * },
     * {
     *      "id" :2,
     *      "product_name" :"Ghế"
     *      "product_price" : 2000
     *      "product_image" :"xxxx"
     * }
     * ],
     * ]
     * },
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
     * delete order
     *
     *
     * @queryParam id int required Example : 1
     *  @response 201 {
     * "message": [
     * {
     *  "OK"
     *  }
     *
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
