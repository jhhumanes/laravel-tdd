<?php

namespace Tests\Feature\Http\Controllers\ProductController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    public function test_form()
    {
        $this->get(route('products.create'))
            ->assertStatus(200)
            ->assertSee(route('products.store'));
    }

    public function test_store()
    {
        $data = ['name' => 'Producto de prueba'];
        
        $this->post(route('products.store'), $data)
            ->assertRedirect(route('products.index'));
        
        $this->assertDatabaseHas('products', $data);
    }

    public function test_validate()
    {
        $data = ['name' => ''];
        
        $this->post(route('products.store'), $data)
            ->assertSessionHasErrors('name')
            ->assertStatus(302);
    }
}
