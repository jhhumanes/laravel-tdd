<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_detail()
    {
        $product = Product::factory()->create();

        $this->get(route('products.show', $product))
        ->assertStatus(200)
        ->assertSee($product->name);
    }
}
