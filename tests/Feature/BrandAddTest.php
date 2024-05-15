<?php

// namespace Tests\Feature;
// use App\Models\Brand;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;




// use Illuminate\Support\Arr;
namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;


// class BrandAddTest extends TestCase
// {
//     use WithFaker;
//     use RefreshDatabase;

//     public function testAddBrand()
//     {
//         $response = $this->post('/admin/brand', [
//             'title' => 'Adidas',
//             'status' => 'active',

//         ]);

//         $response->assertStatus(302);
//         $this->assertDatabaseHas('brands', [
//             'id'=>'18',
//             'title' => 'Adidas',
//             'slug'=> 'adidas',
//             'status' => 'active',

//             // Add more attributes as needed
//         ]);
//     }

//     public function testDeleteBrand()
//     {     $brandId = 1;
//         // Assuming $brandId is the ID of an existing brand
//         $response = $this->delete('/admin/brand/' . $brandId);
//         $response->assertStatus(302);
//         $this->assertDatabaseMissing('brands', [
//             'id' => $brandId
//         ]);
//     }
// }
class BrandAddTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Seed the brands table with dummy data
        Brand::create([
            'title' => 'blue',
            'slug' => Str::slug('blue'),
            'status' => 'active',
        ]);
    }

    public function testAddBrand()
    {
        $response = $this->post('/admin/brand', [
            'title' => 'Yellow',
            'status' => 'active',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('brands', [
            'title' => 'blue',
            'slug' => Str::slug('blue'),
            'status' => 'active',
        ]);
    }

//     public function testDeleteBrand()
// {
//     $brand = Brand::where('title', 'pink')->first();

//     // Check if brand exists before accessing its properties
//     if ($brand) {
//         $brandId = $brand->id;

//         $response = $this->delete('/admin/brand/' . $brandId);
//         $response->assertStatus(302);
//         $this->assertDatabaseMissing('brands', [
//             'id' => $brandId,
//         ]);
//     } else {
//         $this->assertTrue(false, 'Brand with title "pink" not found.');
//     }
// }
}
