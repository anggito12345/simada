<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\mutasi_detil;

class mutasi_detilApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mutasi_detils', $mutasiDetil
        );

        $this->assertApiResponse($mutasiDetil);
    }

    /**
     * @test
     */
    public function test_read_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/mutasi_detils/'.$mutasiDetil->id
        );

        $this->assertApiResponse($mutasiDetil->toArray());
    }

    /**
     * @test
     */
    public function test_update_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->create();
        $editedmutasi_detil = factory(mutasi_detil::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mutasi_detils/'.$mutasiDetil->id,
            $editedmutasi_detil
        );

        $this->assertApiResponse($editedmutasi_detil);
    }

    /**
     * @test
     */
    public function test_delete_mutasi_detil()
    {
        $mutasiDetil = factory(mutasi_detil::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mutasi_detils/'.$mutasiDetil->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mutasi_detils/'.$mutasiDetil->id
        );

        $this->response->assertStatus(404);
    }
}
