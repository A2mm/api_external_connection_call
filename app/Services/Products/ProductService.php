<?php

namespace App\Services\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function index(array $filters)
    {
        return Product::paginate(paginationSize());
    }

    public function show(Product $product): Product
    {
        return $product;
    }
}
