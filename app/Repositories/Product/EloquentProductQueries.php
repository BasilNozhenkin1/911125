<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;


class EloquentProductQueries implements ProductQueries
{
    public function getCategories($request)
    {
        $productsAssociatedWithCategoriesQuery = Product::query();

        if (isset($request['products']))
        {
            $productFilters = $request['products'];
            $productsAssociatedWithCategoriesQuery = $this->filter($productsAssociatedWithCategoriesQuery, $productFilters);
        }

        if (isset($request['categories']))
        {
            $categoryFilters = $request['categories'];
            $productsAssociatedWithCategoriesQuery->whereHas('categories',  function($query) use ($categoryFilters)
                {
                    $this->filter($query, $categoryFilters, 'categories.');
                }
            );
        }

        return $productsAssociatedWithCategoriesQuery->get();
    }

    public function getGroups($request)
    {
        $productsAssociatedWithGroupsQuery = Product::query();

        if (isset($request['products']))
        {
            $productFilters = $request['products'];
            $productsAssociatedWithGroupsQuery = $this->filter($productsAssociatedWithGroupsQuery, $productFilters);
        }

        if (isset($request['groups']))
        {
            $categoryGroups = $request['groups'];
            $productsAssociatedWithGroupsQuery->whereHas('groups',  function($query) use ($categoryGroups)
            {
                $this->filter($query, $categoryGroups, 'groups.');
            }
            );
        }

        return $productsAssociatedWithGroupsQuery->get();
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    private function filter(Builder $query, array $filters, string $tableName = ''): Builder
    {
        foreach ($filters as $name => $filter)
        {
            if (isset($filter['operation']) && isset($filter['value']))
            {
                switch ($filter['operation'])
                {
                    case '=':
                        $query->where($tableName.$name, $filter['value']);
                        break;
                    case 'LIKE':
                        $query->where($tableName.$name, 'like', "%{$filter['value']}%");
                        break;
                }
            }

            if (isset($filter['sort']))
            {
                $query->orderBy($tableName.$name, $filter['sort']);
            }
        }

        return $query;
    }
}
