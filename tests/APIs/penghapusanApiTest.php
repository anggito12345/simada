<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\penghapusan;

class penghapusanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/penghapusans', $penghapusan
        );

        $this->assertApiResponse($penghapusan);
    }

    /**
     * @test
     */
    public function test_read_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/penghapusans/'.$penghapusan->id
        );

        $this->assertApiResponse($penghapusan->toArray());
    }

    /**
     * @test
     */
    public function test_update_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->create();
        $editedpenghapusan = factory(penghapusan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/penghapusans/'.$penghapusan->id,
            $editedpenghapusan
        );

        $this->assertApiResponse($editedpenghapusan);
    }

    /**
     * @test
     */
    public function test_delete_penghapusan()
    {
        $penghapusan = factory(penghapusan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/penghapusans/'.$penghapusan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/penghapusans/'.$penghapusan->id
        );

        $this->response->assertStatus(404);
    }
}
