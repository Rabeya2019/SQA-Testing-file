<?php

namespace Tests\Feature;


use App\Models\Admin;
use App\Models\Storage;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Arr;


class ProductUpdateStatusTes extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

        public function test_admin_can_update_product_status()
        {


        $admin =Admin::factory()->create([ 'is_admin' => true ]);
        $this->actingAs($admin);


            $category = Category::factory()->create(); //a category that the prodct  belong to
            $product = Product::factory()->create([
                'cat_id' => $category->id,
                'status' => 'active',
            ]);


            $response = $this->get('/backend.product.edit' . $product->id . '/edit');

                     $response->assertStatus(200);
            $updateData = [
                'status' => 'inactive',
            ];

            $response = $this->put('/backend.product.edit' . $product->id, $updateData);

            $response->assertStatus(302);
            $product->refresh();
            $this->assertEquals('inactive', $product->status);



    }



}
