<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\organisasi;

class organisasiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_organisasi()
    {
        $organisasi = factory(organisasi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/organisasis', $organisasi
        );

        $this->assertApiResponse($organisasi);
    }

    /**
     * @test
     */
    public function test_read_organisasi()
    {
        $organisasi = factory(organisasi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/organisasis/'.$organisasi->id
        );

        $this->assertApiResponse($organisasi->toArray());
    }

    /**
     * @test
     */
    public function test_update_organisasi()
    {
        $organisasi = factory(organisasi::class)->create();
        $editedorganisasi = factory(organisasi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/organisasis/'.$organisasi->id,
            $editedorganisasi
        );

        $this->assertApiResponse($editedorganisasi);
    }

    /**
     * @test
     */
    public function test_delete_organisasi()
    {
        $organisasi = factory(organisasi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/organisasis/'.$organisasi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/organisasis/'.$organisasi->id
        );

        $this->response->assertStatus(404);
    }
}
