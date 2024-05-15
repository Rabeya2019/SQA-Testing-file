<?php


namespace Tests\Feature;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;





use App\User;


use Illuminate\Support\Arr;


class CategoryDeleteTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    public function testDeleteCategory()
    {
        $catId = 1;
        // Assuming $userId is the ID of an existing user
        $response = $this->delete('/admin/categories/' . $catId);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('categories', [
            'id' => $catId
        ]);
    }

}
