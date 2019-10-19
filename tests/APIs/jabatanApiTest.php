<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\jabatan;

class jabatanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_jabatan()
    {
        $jabatan = factory(jabatan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/jabatans', $jabatan
        );

        $this->assertApiResponse($jabatan);
    }

    /**
     * @test
     */
    public function test_read_jabatan()
    {
        $jabatan = factory(jabatan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/jabatans/'.$jabatan->id
        );

        $this->assertApiResponse($jabatan->toArray());
    }

    /**
     * @test
     */
    public function test_update_jabatan()
    {
        $jabatan = factory(jabatan::class)->create();
        $editedjabatan = factory(jabatan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/jabatans/'.$jabatan->id,
            $editedjabatan
        );

        $this->assertApiResponse($editedjabatan);
    }

    /**
     * @test
     */
    public function test_delete_jabatan()
    {
        $jabatan = factory(jabatan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/jabatans/'.$jabatan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/jabatans/'.$jabatan->id
        );

        $this->response->assertStatus(404);
    }
}
