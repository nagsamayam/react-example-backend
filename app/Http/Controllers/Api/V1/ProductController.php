<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use Exception;
use Domain\Products\Models\Product;
use App\Http\Controllers\Controller;
use Domain\Products\V1\Dtos\ProductData;
use App\Http\Resources\V1\ProductResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Products\V1\ProductRequest;
use Domain\Products\V1\Actions\UpdateProductAction;
use Domain\Products\V1\Actions\CreateNewProductAction;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::latest()->paginate());
    }

    public function store(ProductRequest $request, CreateNewProductAction $handler)
    {
        try {
            $productData = ProductData::fromRequest($request);

            $product = ($handler)($productData);

            return response(new ProductResource($product, Response::HTTP_CREATED));
        } catch (Exception) {
            return response(['message' => 'Some thing went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);

        return new ProductResource($product);
    }

    public function update(ProductRequest $request, $id, UpdateProductAction $handler)
    {
        try {
            $product = Product::find($id);
            $productData = ProductData::fromRequest($request);

            $product = ($handler)($product, $productData);

            return response(new ProductResource($product, Response::HTTP_ACCEPTED));
        } catch (Exception) {
            return response(['message' => 'Some thing went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return response()->noContent();
    }
}
