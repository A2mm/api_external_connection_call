<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Callers\HttpCaller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class FetchExternalProductsService
{
    protected HttpCaller $httpCaller;
    protected string $base_url;

    public function __construct(HttpCaller $httpCaller)
    {
        $this->httpCaller = $httpCaller;
        $this->base_url   = config('integrations.products.external_url');
    }

    public function fetchProducts()
    {
        $response = $this->httpCaller->sendRequest(
            $this->base_url,
            'get',
            'products'
        );

        $product_details = $response['products'];

        foreach ($product_details as $product_detail) {
            Product::updateOrCreate(
                ['id' => $product_detail['id']],
                [
                    'title'       => $product_detail['title'],
                    'description' => $product_detail['description'],
                    'price'       => $product_detail['price'],
                    'thumbnail'   => $product_detail['thumbnail'],
                ]
            );
        }

    }
}
