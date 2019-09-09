<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\statustanah;

class statustanahApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_statustanah()
    {
        $statustanah = factory(statustanah::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/statustanahs', $statustanah
        );

        $this->assertApiResponse($statustanah);
    }

    /**
     * @test
     */
    public function test_read_statustanah()
    {
        $statustanah = factory(statustanah::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/statustanahs/'.$statustanah->id
        );

        $this->assertApiResponse($statustanah->toArray());
    }

    /**
     * @test
     */
    public function test_update_statustanah()
    {
        $statustanah = factory(statustanah::class)->create();
        $editedstatustanah = factory(statustanah::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/statustanahs/'.$statustanah->id,
            $editedstatustanah
        );

        $this->assertApiResponse($editedstatustanah);
    }

    /**
     * @test
     */
    public function test_delete_statustanah()
    {
        $statustanah = factory(statustanah::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/statustanahs/'.$statustanah->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/statustanahs/'.$statustanah->id
        );

        $this->response->assertStatus(404);
    }
}
