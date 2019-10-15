<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\pemanfaatan;

class pemanfaatanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pemanfaatans', $pemanfaatan
        );

        $this->assertApiResponse($pemanfaatan);
    }

    /**
     * @test
     */
    public function test_read_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/pemanfaatans/'.$pemanfaatan->id
        );

        $this->assertApiResponse($pemanfaatan->toArray());
    }

    /**
     * @test
     */
    public function test_update_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->create();
        $editedpemanfaatan = factory(pemanfaatan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pemanfaatans/'.$pemanfaatan->id,
            $editedpemanfaatan
        );

        $this->assertApiResponse($editedpemanfaatan);
    }

    /**
     * @test
     */
    public function test_delete_pemanfaatan()
    {
        $pemanfaatan = factory(pemanfaatan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pemanfaatans/'.$pemanfaatan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pemanfaatans/'.$pemanfaatan->id
        );

        $this->response->assertStatus(404);
    }
}
