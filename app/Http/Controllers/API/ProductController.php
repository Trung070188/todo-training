<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('view', Products::class);
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
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->authorize('create', Products::class);
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
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $this->authorize('show', Products::class);
            $product = $this->productRepository->show($id);
            return new ProductResource($product);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $this->authorize('update', Products::class);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->authorize('delete', Products::class);
            $this->productRepository->delete($id);

            return response()->json(['message' => 'Ok']);

        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }
}
