<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detilmesin;

class detilmesinApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detilmesins', $detilmesin
        );

        $this->assertApiResponse($detilmesin);
    }

    /**
     * @test
     */
    public function test_read_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/detilmesins/'.$detilmesin->id
        );

        $this->assertApiResponse($detilmesin->toArray());
    }

    /**
     * @test
     */
    public function test_update_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->create();
        $editeddetilmesin = factory(detilmesin::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detilmesins/'.$detilmesin->id,
            $editeddetilmesin
        );

        $this->assertApiResponse($editeddetilmesin);
    }

    /**
     * @test
     */
    public function test_delete_detilmesin()
    {
        $detilmesin = factory(detilmesin::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detilmesins/'.$detilmesin->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detilmesins/'.$detilmesin->id
        );

        $this->response->assertStatus(404);
    }
}
