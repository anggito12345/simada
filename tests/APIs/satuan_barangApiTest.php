<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\satuan_barang;

class satuan_barangApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/satuan_barangs', $satuanBarang
        );

        $this->assertApiResponse($satuanBarang);
    }

    /**
     * @test
     */
    public function test_read_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/satuan_barangs/'.$satuanBarang->id
        );

        $this->assertApiResponse($satuanBarang->toArray());
    }

    /**
     * @test
     */
    public function test_update_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->create();
        $editedsatuan_barang = factory(satuan_barang::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/satuan_barangs/'.$satuanBarang->id,
            $editedsatuan_barang
        );

        $this->assertApiResponse($editedsatuan_barang);
    }

    /**
     * @test
     */
    public function test_delete_satuan_barang()
    {
        $satuanBarang = factory(satuan_barang::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/satuan_barangs/'.$satuanBarang->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/satuan_barangs/'.$satuanBarang->id
        );

        $this->response->assertStatus(404);
    }
}
