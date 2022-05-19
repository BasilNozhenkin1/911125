<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Repositories\Product\ProductQueries;
use Illuminate\Http\Request;

final class ProductController extends Controller
{
    public function getCategories(ProductCategoryRequest $request, ProductQueries $productQueries): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            $productQueries->getCategories($request->validated())
        );
    }

    public function getGroups(Request $request, ProductQueries $productQueries): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            $productQueries->getGroups($request->all())
        );
    }


}