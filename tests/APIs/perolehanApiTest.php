<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\perolehan;

class perolehanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_perolehan()
    {
        $perolehan = factory(perolehan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/perolehans', $perolehan
        );

        $this->assertApiResponse($perolehan);
    }

    /**
     * @test
     */
    public function test_read_perolehan()
    {
        $perolehan = factory(perolehan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/perolehans/'.$perolehan->id
        );

        $this->assertApiResponse($perolehan->toArray());
    }

    /**
     * @test
     */
    public function test_update_perolehan()
    {
        $perolehan = factory(perolehan::class)->create();
        $editedperolehan = factory(perolehan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/perolehans/'.$perolehan->id,
            $editedperolehan
        );

        $this->assertApiResponse($editedperolehan);
    }

    /**
     * @test
     */
    public function test_delete_perolehan()
    {
        $perolehan = factory(perolehan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/perolehans/'.$perolehan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/perolehans/'.$perolehan->id
        );

        $this->response->assertStatus(404);
    }
}
