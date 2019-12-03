<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\inventaris_history;

class inventaris_historyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventaris_histories', $inventarisHistory
        );

        $this->assertApiResponse($inventarisHistory);
    }

    /**
     * @test
     */
    public function test_read_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/inventaris_histories/'.$inventarisHistory->id
        );

        $this->assertApiResponse($inventarisHistory->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->create();
        $editedinventaris_history = factory(inventaris_history::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventaris_histories/'.$inventarisHistory->id,
            $editedinventaris_history
        );

        $this->assertApiResponse($editedinventaris_history);
    }

    /**
     * @test
     */
    public function test_delete_inventaris_history()
    {
        $inventarisHistory = factory(inventaris_history::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventaris_histories/'.$inventarisHistory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventaris_histories/'.$inventarisHistory->id
        );

        $this->response->assertStatus(404);
    }
}
