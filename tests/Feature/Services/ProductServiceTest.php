<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use App\Models\Product;
use App\Services\Products\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    private ProductService $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductService();
    }

    public function test_index_returns_paginated_products()
    {
        Product::factory()->count(20)->create();
        $products = $this->productService->index([]);
        $this->assertCount(10, $products);
        $this->assertEquals(20, $products->total());
    }

    public function test_show_returns_correct_product()
    {
        $product = Product::factory()->create();
        $result = $this->productService->show($product);
        $this->assertEquals($product->id, $result->id);
    }
}
