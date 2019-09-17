<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detilbangunan;

class detilbangunanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detilbangunans', $detilbangunan
        );

        $this->assertApiResponse($detilbangunan);
    }

    /**
     * @test
     */
    public function test_read_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/detilbangunans/'.$detilbangunan->id
        );

        $this->assertApiResponse($detilbangunan->toArray());
    }

    /**
     * @test
     */
    public function test_update_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->create();
        $editeddetilbangunan = factory(detilbangunan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detilbangunans/'.$detilbangunan->id,
            $editeddetilbangunan
        );

        $this->assertApiResponse($editeddetilbangunan);
    }

    /**
     * @test
     */
    public function test_delete_detilbangunan()
    {
        $detilbangunan = factory(detilbangunan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detilbangunans/'.$detilbangunan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detilbangunans/'.$detilbangunan->id
        );

        $this->response->assertStatus(404);
    }
}
