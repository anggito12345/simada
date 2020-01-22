<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\reklas_detil;

class reklas_detilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/reklas_detils', $reklasDetil
        );

        $this->assertApiResponse($reklasDetil);
    }

    /**
     * @test
     */
    public function test_read_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/reklas_detils/'.$reklasDetil->id
        );

        $this->assertApiResponse($reklasDetil->toArray());
    }

    /**
     * @test
     */
    public function test_update_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->create();
        $editedreklas_detil = factory(reklas_detil::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/reklas_detils/'.$reklasDetil->id,
            $editedreklas_detil
        );

        $this->assertApiResponse($editedreklas_detil);
    }

    /**
     * @test
     */
    public function test_delete_reklas_detil()
    {
        $reklasDetil = factory(reklas_detil::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/reklas_detils/'.$reklasDetil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/reklas_detils/'.$reklasDetil->id
        );

        $this->response->assertStatus(404);
    }
}
