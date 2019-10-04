<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\pemeliharaan;

class pemeliharaanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pemeliharaans', $pemeliharaan
        );

        $this->assertApiResponse($pemeliharaan);
    }

    /**
     * @test
     */
    public function test_read_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/pemeliharaans/'.$pemeliharaan->id
        );

        $this->assertApiResponse($pemeliharaan->toArray());
    }

    /**
     * @test
     */
    public function test_update_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->create();
        $editedpemeliharaan = factory(pemeliharaan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pemeliharaans/'.$pemeliharaan->id,
            $editedpemeliharaan
        );

        $this->assertApiResponse($editedpemeliharaan);
    }

    /**
     * @test
     */
    public function test_delete_pemeliharaan()
    {
        $pemeliharaan = factory(pemeliharaan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pemeliharaans/'.$pemeliharaan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pemeliharaans/'.$pemeliharaan->id
        );

        $this->response->assertStatus(404);
    }
}
