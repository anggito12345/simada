<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\lokasi;

class lokasiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_lokasi()
    {
        $lokasi = factory(lokasi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/lokasis', $lokasi
        );

        $this->assertApiResponse($lokasi);
    }

    /**
     * @test
     */
    public function test_read_lokasi()
    {
        $lokasi = factory(lokasi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/lokasis/'.$lokasi->id
        );

        $this->assertApiResponse($lokasi->toArray());
    }

    /**
     * @test
     */
    public function test_update_lokasi()
    {
        $lokasi = factory(lokasi::class)->create();
        $editedlokasi = factory(lokasi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/lokasis/'.$lokasi->id,
            $editedlokasi
        );

        $this->assertApiResponse($editedlokasi);
    }

    /**
     * @test
     */
    public function test_delete_lokasi()
    {
        $lokasi = factory(lokasi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/lokasis/'.$lokasi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/lokasis/'.$lokasi->id
        );

        $this->response->assertStatus(404);
    }
}
