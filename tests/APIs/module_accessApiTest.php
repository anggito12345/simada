<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\module_access;

class module_accessApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_module_access()
    {
        $moduleAccess = factory(module_access::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/module_accesses', $moduleAccess
        );

        $this->assertApiResponse($moduleAccess);
    }

    /**
     * @test
     */
    public function test_read_module_access()
    {
        $moduleAccess = factory(module_access::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/module_accesses/'.$moduleAccess->id
        );

        $this->assertApiResponse($moduleAccess->toArray());
    }

    /**
     * @test
     */
    public function test_update_module_access()
    {
        $moduleAccess = factory(module_access::class)->create();
        $editedmodule_access = factory(module_access::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/module_accesses/'.$moduleAccess->id,
            $editedmodule_access
        );

        $this->assertApiResponse($editedmodule_access);
    }

    /**
     * @test
     */
    public function test_delete_module_access()
    {
        $moduleAccess = factory(module_access::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/module_accesses/'.$moduleAccess->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/module_accesses/'.$moduleAccess->id
        );

        $this->response->assertStatus(404);
    }
}
