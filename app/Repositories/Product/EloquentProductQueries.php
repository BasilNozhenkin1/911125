<?php

namespace App\Repositories\Product;

use App\Models\Product;

class EloquentProductQueries implements ProductQueries
{
    public function getCategories($request)
    {
        $categoryFilters = $request['categories'];

        $productsAssociatedWithCategoriesQuery = Product::query()
            ->with(
                [
                    'categories' => function($query) use ($categoryFilters)
                    {
                        foreach ($categoryFilters as $name => $categoryFilter)
                        {
                            switch ($name)
                            {
                                case 'id':
                                    $query->where('id', $categoryFilter['value']);
                                    break;
                                case 'name':
                                    $query->where('name', 'like', $categoryFilter['value']);
                                    break;
                            }

                            if (isset($categoryFilter['sort']))
                            {
                                $query->orderBy($name, $categoryFilter['sort']);
                            }
                        }
                    }
                ]
            )
        ;

        return $productsAssociatedWithCategoriesQuery->get();
    }

    public function getGroups($request)
    {
        dd($request);
    }

}
