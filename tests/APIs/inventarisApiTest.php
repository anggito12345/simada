<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\inventaris;

class inventarisApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventaris()
    {
        $inventaris = factory(inventaris::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventaris', $inventaris
        );

        $this->assertApiResponse($inventaris);
    }

    /**
     * @test
     */
    public function test_read_inventaris()
    {
        $inventaris = factory(inventaris::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/inventaris/'.$inventaris->id
        );

        $this->assertApiResponse($inventaris->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventaris()
    {
        $inventaris = factory(inventaris::class)->create();
        $editedinventaris = factory(inventaris::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventaris/'.$inventaris->id,
            $editedinventaris
        );

        $this->assertApiResponse($editedinventaris);
    }

    /**
     * @test
     */
    public function test_delete_inventaris()
    {
        $inventaris = factory(inventaris::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventaris/'.$inventaris->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventaris/'.$inventaris->id
        );

        $this->response->assertStatus(404);
    }
}
