<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\merkbarang;

class merkbarangApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/merkbarangs', $merkbarang
        );

        $this->assertApiResponse($merkbarang);
    }

    /**
     * @test
     */
    public function test_read_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/merkbarangs/'.$merkbarang->id
        );

        $this->assertApiResponse($merkbarang->toArray());
    }

    /**
     * @test
     */
    public function test_update_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->create();
        $editedmerkbarang = factory(merkbarang::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/merkbarangs/'.$merkbarang->id,
            $editedmerkbarang
        );

        $this->assertApiResponse($editedmerkbarang);
    }

    /**
     * @test
     */
    public function test_delete_merkbarang()
    {
        $merkbarang = factory(merkbarang::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/merkbarangs/'.$merkbarang->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/merkbarangs/'.$merkbarang->id
        );

        $this->response->assertStatus(404);
    }
}
