<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\barang;

class barangApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_barang()
    {
        $barang = factory(barang::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/barangs', $barang
        );

        $this->assertApiResponse($barang);
    }

    /**
     * @test
     */
    public function test_read_barang()
    {
        $barang = factory(barang::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/barangs/'.$barang->id
        );

        $this->assertApiResponse($barang->toArray());
    }

    /**
     * @test
     */
    public function test_update_barang()
    {
        $barang = factory(barang::class)->create();
        $editedbarang = factory(barang::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/barangs/'.$barang->id,
            $editedbarang
        );

        $this->assertApiResponse($editedbarang);
    }

    /**
     * @test
     */
    public function test_delete_barang()
    {
        $barang = factory(barang::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/barangs/'.$barang->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/barangs/'.$barang->id
        );

        $this->response->assertStatus(404);
    }
}
