<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\rka_detil;

class rka_detilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rka_detils', $rkaDetil
        );

        $this->assertApiResponse($rkaDetil);
    }

    /**
     * @test
     */
    public function test_read_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/rka_detils/'.$rkaDetil->id
        );

        $this->assertApiResponse($rkaDetil->toArray());
    }

    /**
     * @test
     */
    public function test_update_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->create();
        $editedrka_detil = factory(rka_detil::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rka_detils/'.$rkaDetil->id,
            $editedrka_detil
        );

        $this->assertApiResponse($editedrka_detil);
    }

    /**
     * @test
     */
    public function test_delete_rka_detil()
    {
        $rkaDetil = factory(rka_detil::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rka_detils/'.$rkaDetil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rka_detils/'.$rkaDetil->id
        );

        $this->response->assertStatus(404);
    }
}
