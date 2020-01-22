<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\reklas;

class reklasApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_reklas()
    {
        $reklas = factory(reklas::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/reklas', $reklas
        );

        $this->assertApiResponse($reklas);
    }

    /**
     * @test
     */
    public function test_read_reklas()
    {
        $reklas = factory(reklas::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/reklas/'.$reklas->id
        );

        $this->assertApiResponse($reklas->toArray());
    }

    /**
     * @test
     */
    public function test_update_reklas()
    {
        $reklas = factory(reklas::class)->create();
        $editedreklas = factory(reklas::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/reklas/'.$reklas->id,
            $editedreklas
        );

        $this->assertApiResponse($editedreklas);
    }

    /**
     * @test
     */
    public function test_delete_reklas()
    {
        $reklas = factory(reklas::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/reklas/'.$reklas->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/reklas/'.$reklas->id
        );

        $this->response->assertStatus(404);
    }
}
