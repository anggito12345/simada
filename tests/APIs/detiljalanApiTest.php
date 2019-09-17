<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detiljalan;

class detiljalanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detiljalans', $detiljalan
        );

        $this->assertApiResponse($detiljalan);
    }

    /**
     * @test
     */
    public function test_read_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/detiljalans/'.$detiljalan->id
        );

        $this->assertApiResponse($detiljalan->toArray());
    }

    /**
     * @test
     */
    public function test_update_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->create();
        $editeddetiljalan = factory(detiljalan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detiljalans/'.$detiljalan->id,
            $editeddetiljalan
        );

        $this->assertApiResponse($editeddetiljalan);
    }

    /**
     * @test
     */
    public function test_delete_detiljalan()
    {
        $detiljalan = factory(detiljalan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detiljalans/'.$detiljalan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detiljalans/'.$detiljalan->id
        );

        $this->response->assertStatus(404);
    }
}
