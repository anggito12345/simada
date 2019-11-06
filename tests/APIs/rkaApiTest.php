<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\rka;

class rkaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rka()
    {
        $rka = factory(rka::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rkas', $rka
        );

        $this->assertApiResponse($rka);
    }

    /**
     * @test
     */
    public function test_read_rka()
    {
        $rka = factory(rka::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/rkas/'.$rka->id
        );

        $this->assertApiResponse($rka->toArray());
    }

    /**
     * @test
     */
    public function test_update_rka()
    {
        $rka = factory(rka::class)->create();
        $editedrka = factory(rka::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rkas/'.$rka->id,
            $editedrka
        );

        $this->assertApiResponse($editedrka);
    }

    /**
     * @test
     */
    public function test_delete_rka()
    {
        $rka = factory(rka::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rkas/'.$rka->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rkas/'.$rka->id
        );

        $this->response->assertStatus(404);
    }
}
