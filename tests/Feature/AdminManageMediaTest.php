<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use App\Models\Admin;
use App\Services\AdminService;
use Mockery;

use Illuminate\Support\Str;

class AdminMediaManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_image_file()
    {
        $admin = Admin::factory()->create([ 'is_admin' => true ]);
        $this->actingAs($admin);
        $testImagePath = '/storage/app/public/photos/1/banner-06.jpg';
        $fileName = 'testingbanner.jpg';


        Storage::disk('public')->put($fileName, file_get_contents($testImagePath));

        $response = $this->post('file-manager', [
            'file' => $fileName,
        ]);

        $response->assertStatus(201);
        $this->assertTrue(Storage::disk('public')->exists($fileName));

        //FAIL
    }



    public function test_admin_can_see_existing_file_preview()
    {

        $admin = Admin::factory()->create([ 'is_admin' => true ]);
        $this->actingAs($admin);
        $testImagePath = '/storage/app/public/files/1/sample_image_cropped_1715431907.jpg';
        $fileName = 'Sample.jpg'; /
        Storage::disk('public')->put($fileName, file_get_contents($testImagePath));
        $response = $this->post('/admin/media/preview', [
            'file' => $fileName,
        ]);

        $response->assertStatus(200);
                $this->assertTrue(Storage::disk('public')->exists($fileName));
                //FAIL
    }






}
