<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\mitra;

class mitraApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mitra()
    {
        $mitra = factory(mitra::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mitras', $mitra
        );

        $this->assertApiResponse($mitra);
    }

    /**
     * @test
     */
    public function test_read_mitra()
    {
        $mitra = factory(mitra::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/mitras/'.$mitra->id
        );

        $this->assertApiResponse($mitra->toArray());
    }

    /**
     * @test
     */
    public function test_update_mitra()
    {
        $mitra = factory(mitra::class)->create();
        $editedmitra = factory(mitra::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mitras/'.$mitra->id,
            $editedmitra
        );

        $this->assertApiResponse($editedmitra);
    }

    /**
     * @test
     */
    public function test_delete_mitra()
    {
        $mitra = factory(mitra::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mitras/'.$mitra->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mitras/'.$mitra->id
        );

        $this->response->assertStatus(404);
    }
}
