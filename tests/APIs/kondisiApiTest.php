<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\kondisi;

class kondisiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kondisi()
    {
        $kondisi = factory(kondisi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kondisis', $kondisi
        );

        $this->assertApiResponse($kondisi);
    }

    /**
     * @test
     */
    public function test_read_kondisi()
    {
        $kondisi = factory(kondisi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/kondisis/'.$kondisi->id
        );

        $this->assertApiResponse($kondisi->toArray());
    }

    /**
     * @test
     */
    public function test_update_kondisi()
    {
        $kondisi = factory(kondisi::class)->create();
        $editedkondisi = factory(kondisi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kondisis/'.$kondisi->id,
            $editedkondisi
        );

        $this->assertApiResponse($editedkondisi);
    }

    /**
     * @test
     */
    public function test_delete_kondisi()
    {
        $kondisi = factory(kondisi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kondisis/'.$kondisi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kondisis/'.$kondisi->id
        );

        $this->response->assertStatus(404);
    }
}
