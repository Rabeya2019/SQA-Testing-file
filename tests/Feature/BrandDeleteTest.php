<?php

namespace Tests\Feature;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;




use Illuminate\Support\Arr;


class BrandDeleteTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    public function testDeleteBrand()
    {     $brandId = 1;
        // Assuming $brandId is the ID of an existing brand
        $response = $this->delete('/admin/brand/' . $brandId);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('brands', [
            'id' => $brandId
        ]);
    }
}
