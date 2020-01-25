<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\koreksi_detil;

class koreksi_detilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/koreksi_detils', $koreksiDetil
        );

        $this->assertApiResponse($koreksiDetil);
    }

    /**
     * @test
     */
    public function test_read_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/koreksi_detils/'.$koreksiDetil->id
        );

        $this->assertApiResponse($koreksiDetil->toArray());
    }

    /**
     * @test
     */
    public function test_update_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->create();
        $editedkoreksi_detil = factory(koreksi_detil::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/koreksi_detils/'.$koreksiDetil->id,
            $editedkoreksi_detil
        );

        $this->assertApiResponse($editedkoreksi_detil);
    }

    /**
     * @test
     */
    public function test_delete_koreksi_detil()
    {
        $koreksiDetil = factory(koreksi_detil::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/koreksi_detils/'.$koreksiDetil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/koreksi_detils/'.$koreksiDetil->id
        );

        $this->response->assertStatus(404);
    }
}
