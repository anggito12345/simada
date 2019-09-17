<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\jenisopd;

class jenisopdApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/jenisopds', $jenisopd
        );

        $this->assertApiResponse($jenisopd);
    }

    /**
     * @test
     */
    public function test_read_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/jenisopds/'.$jenisopd->id
        );

        $this->assertApiResponse($jenisopd->toArray());
    }

    /**
     * @test
     */
    public function test_update_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->create();
        $editedjenisopd = factory(jenisopd::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/jenisopds/'.$jenisopd->id,
            $editedjenisopd
        );

        $this->assertApiResponse($editedjenisopd);
    }

    /**
     * @test
     */
    public function test_delete_jenisopd()
    {
        $jenisopd = factory(jenisopd::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/jenisopds/'.$jenisopd->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/jenisopds/'.$jenisopd->id
        );

        $this->response->assertStatus(404);
    }
}
