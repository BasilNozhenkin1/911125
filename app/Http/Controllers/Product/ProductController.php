<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Http\Requests\ProductGroupRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductGroupResource;
use App\Repositories\Product\ProductQueries;

final class ProductController extends Controller
{
    public function getCategories(ProductCategoryRequest $request, ProductQueries $productQueries): \Illuminate\Http\JsonResponse
    {

        $productCategories = $productQueries->getCategories($request->validated());

        return response()->json(
            ProductCategoryResource::collection($productCategories)
        );
    }

    public function getGroups(ProductGroupRequest $request, ProductQueries $productQueries): \Illuminate\Http\JsonResponse
    {
        $productGroups = $productQueries->getGroups($request->validated());

        return response()->json(
            ProductGroupResource::collection($productGroups)
        );
    }


}