<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function test_form()
    {
        $product = Product::factory()->create();

        $this->get(route('products.edit', $product))
            ->assertStatus(200)
            ->assertSee($product->name)
            ->assertSee(route('products.update', $product));
    }

    public function test_update()
    {
        $product = Product::factory()->create();
        $data = ['name' => 'Nuevo nombre'];
        
        $this->put(route('products.update', $product), $data)
            ->assertRedirect(route('products.index'));
        
        $this->assertDatabaseHas('products', $data);
    }

    public function test_validate()
    {
        $product = Product::factory()->create();
        $data = ['name' => null];
        
        $this->put(route('products.update', $product), $data)
            ->assertSessionHasErrors('name')
            ->assertStatus(302);
    }
}
