<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\koreksi;

class koreksiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_koreksi()
    {
        $koreksi = factory(koreksi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/koreksis', $koreksi
        );

        $this->assertApiResponse($koreksi);
    }

    /**
     * @test
     */
    public function test_read_koreksi()
    {
        $koreksi = factory(koreksi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/koreksis/'.$koreksi->id
        );

        $this->assertApiResponse($koreksi->toArray());
    }

    /**
     * @test
     */
    public function test_update_koreksi()
    {
        $koreksi = factory(koreksi::class)->create();
        $editedkoreksi = factory(koreksi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/koreksis/'.$koreksi->id,
            $editedkoreksi
        );

        $this->assertApiResponse($editedkoreksi);
    }

    /**
     * @test
     */
    public function test_delete_koreksi()
    {
        $koreksi = factory(koreksi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/koreksis/'.$koreksi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/koreksis/'.$koreksi->id
        );

        $this->response->assertStatus(404);
    }
}
