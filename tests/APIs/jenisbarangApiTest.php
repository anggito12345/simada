<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\jenisbarang;

class jenisbarangApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/jenisbarangs', $jenisbarang
        );

        $this->assertApiResponse($jenisbarang);
    }

    /**
     * @test
     */
    public function test_read_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/jenisbarangs/'.$jenisbarang->id
        );

        $this->assertApiResponse($jenisbarang->toArray());
    }

    /**
     * @test
     */
    public function test_update_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->create();
        $editedjenisbarang = factory(jenisbarang::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/jenisbarangs/'.$jenisbarang->id,
            $editedjenisbarang
        );

        $this->assertApiResponse($editedjenisbarang);
    }

    /**
     * @test
     */
    public function test_delete_jenisbarang()
    {
        $jenisbarang = factory(jenisbarang::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/jenisbarangs/'.$jenisbarang->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/jenisbarangs/'.$jenisbarang->id
        );

        $this->response->assertStatus(404);
    }
}
