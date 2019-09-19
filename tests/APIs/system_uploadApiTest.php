<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\system_upload;

class system_uploadApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_system_upload()
    {
        $systemUpload = factory(system_upload::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/system_uploads', $systemUpload
        );

        $this->assertApiResponse($systemUpload);
    }

    /**
     * @test
     */
    public function test_read_system_upload()
    {
        $systemUpload = factory(system_upload::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/system_uploads/'.$systemUpload->id
        );

        $this->assertApiResponse($systemUpload->toArray());
    }

    /**
     * @test
     */
    public function test_update_system_upload()
    {
        $systemUpload = factory(system_upload::class)->create();
        $editedsystem_upload = factory(system_upload::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/system_uploads/'.$systemUpload->id,
            $editedsystem_upload
        );

        $this->assertApiResponse($editedsystem_upload);
    }

    /**
     * @test
     */
    public function test_delete_system_upload()
    {
        $systemUpload = factory(system_upload::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/system_uploads/'.$systemUpload->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/system_uploads/'.$systemUpload->id
        );

        $this->response->assertStatus(404);
    }
}
