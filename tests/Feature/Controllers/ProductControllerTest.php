<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_products()
    {
        Product::factory()->count(15)->create();
        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertSee('Product List');
        $response->assertSee('View Details', 15);
    }

    public function test_show_displays_single_product()
    {
        $product = Product::factory()->create();
        $response = $this->get(route('products.show', $product));
        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertSee($product->title);
        $response->assertSee($product->description);
        $response->assertSee('$' . $product->price);
    }
}
