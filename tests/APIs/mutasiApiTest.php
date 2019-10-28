<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\mutasi;

class mutasiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mutasi()
    {
        $mutasi = factory(mutasi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mutasis', $mutasi
        );

        $this->assertApiResponse($mutasi);
    }

    /**
     * @test
     */
    public function test_read_mutasi()
    {
        $mutasi = factory(mutasi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/mutasis/'.$mutasi->id
        );

        $this->assertApiResponse($mutasi->toArray());
    }

    /**
     * @test
     */
    public function test_update_mutasi()
    {
        $mutasi = factory(mutasi::class)->create();
        $editedmutasi = factory(mutasi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mutasis/'.$mutasi->id,
            $editedmutasi
        );

        $this->assertApiResponse($editedmutasi);
    }

    /**
     * @test
     */
    public function test_delete_mutasi()
    {
        $mutasi = factory(mutasi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mutasis/'.$mutasi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mutasis/'.$mutasi->id
        );

        $this->response->assertStatus(404);
    }
}
