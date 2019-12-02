<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\pengunaan;

class pengunaanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pengunaans', $pengunaan
        );

        $this->assertApiResponse($pengunaan);
    }

    /**
     * @test
     */
    public function test_read_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/pengunaans/'.$pengunaan->id
        );

        $this->assertApiResponse($pengunaan->toArray());
    }

    /**
     * @test
     */
    public function test_update_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->create();
        $editedpengunaan = factory(pengunaan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pengunaans/'.$pengunaan->id,
            $editedpengunaan
        );

        $this->assertApiResponse($editedpengunaan);
    }

    /**
     * @test
     */
    public function test_delete_pengunaan()
    {
        $pengunaan = factory(pengunaan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pengunaans/'.$pengunaan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pengunaans/'.$pengunaan->id
        );

        $this->response->assertStatus(404);
    }
}
