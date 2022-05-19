<?php

namespace App\Repositories\Product;

interface ProductQueries
{
    public function getCategories($request);

    public function getGroups($request);
}
