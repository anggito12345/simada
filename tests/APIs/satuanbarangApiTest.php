<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\satuanbarang;

class satuanbarangApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/satuanbarangs', $satuanbarang
        );

        $this->assertApiResponse($satuanbarang);
    }

    /**
     * @test
     */
    public function test_read_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/satuanbarangs/'.$satuanbarang->id
        );

        $this->assertApiResponse($satuanbarang->toArray());
    }

    /**
     * @test
     */
    public function test_update_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->create();
        $editedsatuanbarang = factory(satuanbarang::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/satuanbarangs/'.$satuanbarang->id,
            $editedsatuanbarang
        );

        $this->assertApiResponse($editedsatuanbarang);
    }

    /**
     * @test
     */
    public function test_delete_satuanbarang()
    {
        $satuanbarang = factory(satuanbarang::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/satuanbarangs/'.$satuanbarang->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/satuanbarangs/'.$satuanbarang->id
        );

        $this->response->assertStatus(404);
    }
}
