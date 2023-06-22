<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Products\Product;
use App\Repositories\Products\ProductRepository;
use Illuminate\Http\Request;


/**
 * @group Product
 *
 * APIs for managing Product
 *
 * @header Content-Type application/json
 * @authenticated
 */
class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * View product
     *
     * Data trả về list danh sách product
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "name": "Trung",
     *   "email": "admin@gmail.com",
     * }
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('view', Product::class);
            $query = $request->query();
            $products = $this->productRepository->getByQuery($query);
            return ProductResource::collection($products);

        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }
    }

    /**
     * Create product
     *
     * Kết quả trả về file json product
     *
     * @bodyParam product_name string required Example: Cái Bàn
     * @bodyParam product_price string required Example: 2000
     * @bodyParam product_image string required Example: xxxxxx
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "product_name": "Cái Bàn",
     *   "product_price": "2000",
     *   "product_image": "1",
     *    "product_status": 1
     * }
     *
     */
    public function store(ProductCreateRequest $request)
    {
        try {
            $this->authorize('create', Product::class);
            $input = $request->all();
            $product = $this->productRepository->create($input);
            return new ProductResource($product);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }

    /**
     * update product
     *
     * Kết quả trả về file json product
     *
     * @queryParam id required Example :1*
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "product_name": "Cái Bàn 1",
     *   "product_price": "2000",
     *   "product_image": "1",
     *    "product_status": 1
     * }
     *
     */
    public function show($id)
    {
        try {
            $this->authorize('show', Product::class);
            $product = $this->productRepository->show($id);
            return new ProductResource($product);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }

    /**
     * update product
     *
     * Kết quả trả về file json product
     *
     * @queryParam id required Example :1
     * @bodyParam product_name string required Example: Cái Bàn1
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "product_name": "Cái Bàn 1",
     *   "product_price": "2000",
     *   "product_image": "1",
     *    "product_status": 1
     * }
     *
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $this->authorize('update', Product::class);
            $input = $request->all();
            $product = $this->productRepository->update($id, $input);
            return new ProductResource($product);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }

    /**
     * delete product
     *
     * @queryParam id required Example :1
     *
     *@response 201 {
     * "message": {
     *   "OK"
     * }
     *
     */
    public function destroy(string $id)
    {
        try {
            $this->authorize('delete', Product::class);
            $this->productRepository->delete($id);

            return response()->json(['message' => 'Ok']);

        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }
}
