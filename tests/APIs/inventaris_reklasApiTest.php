<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\inventaris_reklas;

class inventaris_reklasApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventaris_reklas', $inventarisReklas
        );

        $this->assertApiResponse($inventarisReklas);
    }

    /**
     * @test
     */
    public function test_read_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/inventaris_reklas/'.$inventarisReklas->id
        );

        $this->assertApiResponse($inventarisReklas->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->create();
        $editedinventaris_reklas = factory(inventaris_reklas::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventaris_reklas/'.$inventarisReklas->id,
            $editedinventaris_reklas
        );

        $this->assertApiResponse($editedinventaris_reklas);
    }

    /**
     * @test
     */
    public function test_delete_inventaris_reklas()
    {
        $inventarisReklas = factory(inventaris_reklas::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventaris_reklas/'.$inventarisReklas->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventaris_reklas/'.$inventarisReklas->id
        );

        $this->response->assertStatus(404);
    }
}
