<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;

class ProductController extends Controller
{
    /**
     * @param ProductService $productService
     */
    public function __construct(private ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $products = $this->productService->index($request->all());
        return view('products.index', compact('products'));
        //return $this->successResponse($data, ResponseAlias::HTTP_OK);
    }

    public function show(Product $product)
    {
        $product = $this->productService->show($product);
        return view('products.show', compact('product'));
        // return $this->successResponse($data, ResponseAlias::HTTP_OK);
    }

}
