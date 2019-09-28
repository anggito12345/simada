<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detilkonstruksi;

class detilkonstruksiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detilkonstruksis', $detilkonstruksi
        );

        $this->assertApiResponse($detilkonstruksi);
    }

    /**
     * @test
     */
    public function test_read_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/detilkonstruksis/'.$detilkonstruksi->id
        );

        $this->assertApiResponse($detilkonstruksi->toArray());
    }

    /**
     * @test
     */
    public function test_update_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->create();
        $editeddetilkonstruksi = factory(detilkonstruksi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detilkonstruksis/'.$detilkonstruksi->id,
            $editeddetilkonstruksi
        );

        $this->assertApiResponse($editeddetilkonstruksi);
    }

    /**
     * @test
     */
    public function test_delete_detilkonstruksi()
    {
        $detilkonstruksi = factory(detilkonstruksi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detilkonstruksis/'.$detilkonstruksi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detilkonstruksis/'.$detilkonstruksi->id
        );

        $this->response->assertStatus(404);
    }
}
