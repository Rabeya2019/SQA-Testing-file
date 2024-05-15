<?php

// namespace Tests\Feature;
namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\Admin;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Arr;


class ProductAddTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_admin_can_add_new_product()
    {
        $admin = Admin::factory()->create([ 'is_admin' => true ]);

        $this->actingAs($admin);
        $category = Category::factory()->create();
        $productData = [
            'title' => 'Test Podruct',
            'summary' => 'This is a test product summary.',
            'description' => 'This is a detailed description of the test product.',
            'photo' => 'peoduct.jpg',
            'size' => ['S', 'M', 'L'],
            'stock' => 10,
            'slug' => 'jeans-pants',
            'cat_id' => $category->id,
            'brand_id' => null, //
            'child_cat_id' => null,
            'is_featured' => 0,
            'status' => 'active',
            'condition' => 'new',
            'price' => 19.99,
            'discount' => null,
        ];

        $response = $this->post('/admin/products', $productData);

        $response->assertStatus(302);
        $this->assertCount(1, Product::all());

        $product = Product::first();
        $product->refresh();
        $this->assertEquals($productData['title'], $product->title);
        $this->assertEquals($productData['summary'], $product->summary);
        $this->assertEquals($productData['stock'], $product->stock);
        $this->assertEquals($productData['cat_id'], $product->cat_id); // Category ID check
        $this->assertEquals($productData['status'], $product->status);
        $this->assertEquals($productData['price'], $product->price);
    }




}

