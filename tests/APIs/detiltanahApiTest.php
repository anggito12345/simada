<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detiltanah;

class detiltanahApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detiltanahs', $detiltanah
        );

        $this->assertApiResponse($detiltanah);
    }

    /**
     * @test
     */
    public function test_read_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/detiltanahs/'.$detiltanah->id
        );

        $this->assertApiResponse($detiltanah->toArray());
    }

    /**
     * @test
     */
    public function test_update_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->create();
        $editeddetiltanah = factory(detiltanah::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detiltanahs/'.$detiltanah->id,
            $editeddetiltanah
        );

        $this->assertApiResponse($editeddetiltanah);
    }

    /**
     * @test
     */
    public function test_delete_detiltanah()
    {
        $detiltanah = factory(detiltanah::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detiltanahs/'.$detiltanah->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detiltanahs/'.$detiltanah->id
        );

        $this->response->assertStatus(404);
    }
}
