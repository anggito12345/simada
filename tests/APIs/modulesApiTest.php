<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\modules;

class modulesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_modules()
    {
        $modules = factory(modules::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/modules', $modules
        );

        $this->assertApiResponse($modules);
    }

    /**
     * @test
     */
    public function test_read_modules()
    {
        $modules = factory(modules::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/modules/'.$modules->id
        );

        $this->assertApiResponse($modules->toArray());
    }

    /**
     * @test
     */
    public function test_update_modules()
    {
        $modules = factory(modules::class)->create();
        $editedmodules = factory(modules::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/modules/'.$modules->id,
            $editedmodules
        );

        $this->assertApiResponse($editedmodules);
    }

    /**
     * @test
     */
    public function test_delete_modules()
    {
        $modules = factory(modules::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/modules/'.$modules->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/modules/'.$modules->id
        );

        $this->response->assertStatus(404);
    }
}
